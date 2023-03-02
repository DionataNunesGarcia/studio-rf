<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Error\Exception\ValidationErrorException;
use App\Services\Datatables\UsersDatatablesService;
use App\Services\Form\UsersFormService;
use App\Services\Manager\UsersManagerService;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AdminController
{
    /**
     * @var UsersFormService $_formService
     */
    private UsersFormService $_formService;

    /**
     * @var UsersManagerService $_managerService
     */
    private UsersManagerService $_managerService;

    /**
     * @var UsersDatatablesService
     */
    private UsersDatatablesService $_datatableService;

    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->_formService = new UsersFormService($this);
        $this->_managerService = new UsersManagerService($this);
        $this->_datatableService = new UsersDatatablesService($this);
    }

    /**
     * @param \Cake\Event\EventInterface $event
     * @return string|void
     */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $allowed = [
            'login',
            'forgetPassword'
        ];
        $this->Authentication->addUnauthenticatedActions($allowed);
        $this->Security->setConfig('unlockedActions', $allowed);
    }

    /**
     * @return string[]
     */
    public static function ignoreListActionsCustom() :array
    {
        return [
            'login',
            'logout',
            'profile',
            'passwordRenew',
            'firstAccess',
            'forgetPassword',
        ];
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
    }

    /**
     * Index Ajax method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function searchAjax()
    {
        $response = $this->_datatableService->getResults();
        $this->RequestHandler->renderAs($this, 'json');
        $this->set(compact('response'));
        $this->set('_serialize', 'response');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $entity = $this->_formService->getEntity();
        if ($this->getRequest()->is('post')) {
            try {
                $response = $this->_managerService->saveEntity();
                $this->Flash->success($response['message']);
                return $this->redirect(['action' => 'edit', $response['data']->id]);
            } catch (ValidationErrorException $ex) {
                $entity = $ex->getEntity();
                $this->Flash->error($ex->getMessage());
            }
        }
        $this->set(compact('entity'));
        $this->render('edit');
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(int $id = null)
    {
        $this->_formService->setId($id);
        $entity = $this->_formService->getEntity();
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            try {
                $id = $id ?? intval($this->request->getData('id'));
                $this->_managerService->setId($id);
                $response = $this->_managerService->saveEntity();
                $this->Flash->success($response['message']);
                return $this->redirect(['action' => 'edit', $response['data']->id]);
            } catch (ValidationErrorException $ex) {
                $entity = $ex->getEntity();
                $this->Flash->error($ex->getMessage());
            }
        }
        $this->set(compact('entity'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($ids)
    {
        $this->RequestHandler->renderAs($this,'json');
        $this->request->allowMethod(['post', 'delete']);

        try {
            $response = $this->_managerService->deletedEntities($ids);
        } catch (\Exception $exc) {
            $code = $exc->getCode() != 0? $exc->getCode() : 403;
            $this->response = $this->response->withStatus($code);
            $response = [
                'message' => $exc->getMessage(),
            ];
        }
        $this->set(compact('response'));
        $this->set('_serialize', 'response');
    }

    /**
     * autocomplete method
     *
     * @return \Cake\Http\Response|void
     */
    public function autocomplete()
    {
        $response = $this->_formService->getAutocomplete();

        $this->RequestHandler->renderAs($this, 'json');
        $this->set(compact('response'));
        $this->set('_serialize', 'response');
    }

    /**
     * Profile method
     *
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function profile()
    {
        $user = $this->Users->getEntity($this->userSession['id']);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            try {
                $this->_managerService->setId($this->userSession['id']);
                $response = $this->_managerService->saveEntity();
                $this->Flash->success($response['message']);
                return $this->redirect(['action' => 'profile']);
            } catch (ValidationErrorException $ex) {
                $user = $ex->getEntity();
                $this->Flash->error($ex->getMessage());
            }
        }
        $this->set(compact('user'));
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        if ($this->request->is('post')) {
            $result = $this->Authentication->getResult();
            // regardless of POST or GET, redirect if user is logged in
            if ($result->isValid()) {
                $user = $this->_formService->buildUserLogged($result->getData()->id);
                if (!$user) {
                    $this->Authentication->logout();
                    $this->Flash->success(__('Você não tem permissão para acessar o sistema, converse com um administrador.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                }
                $this->Authentication->setIdentity($user);
                // redirect to /admin/index after login success

                $this->_managerService->generateLog($user);
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Admin',
                    'action' => 'index',
                ]);
                return $this->redirect($redirect);
            }
            // display error if user submitted and authentication failed
            if (!$result->isValid()) {
                $this->Flash->error(__('Invalid username or password'));
            }
        }
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Flash->warning(__('Você já está logado.'));
            return $this->redirect(['controller' => 'Admin', 'action' => 'index']);
        }
        $this->viewBuilder()->setLayout('login');
    }

    public function logout() {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->success(__('Você saiu do sistema.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }


    public function forgetPassword()
    {
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            try {
                $response = $this->_managerService->forgetPassword();
                $this->Flash->success($response['message']);
            } catch (ValidationErrorException $ex) {
                $this->Flash->error($ex->getMessage());
            }
        }
        return $this->redirect(['action' => 'login']);
    }

}
