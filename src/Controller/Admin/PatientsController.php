<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Error\Exception\ValidationErrorException;
use App\Services\Datatables\ConsultationsDatatablesService;
use App\Services\Datatables\PatientsDatatablesService;
use App\Services\Form\PatientsFormService;
use App\Services\Manager\ConsultationsManagerService;
use App\Services\Manager\PatientsManagerService;

/**
 * Patients Controller
 *
 * @property \App\Model\Table\PatientsTable $Patients
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PatientsController extends AdminController
{
    /**
     * @var PatientsFormService $_formService
     */
    private PatientsFormService $_formService;

    /**
     * @var PatientsManagerService $_managerService
     */
    private PatientsManagerService $_managerService;

    /**
     * @var PatientsDatatablesService $_datatableService
     */
    private PatientsDatatablesService $_datatableService;

    /**
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->_formService = new PatientsFormService($this);
        $this->_managerService = new PatientsManagerService($this);
        $this->_datatableService = new PatientsDatatablesService($this);
    }

    /**
     * @return string[]
     */
    public static function ignoreListActionsCustom() :array
    {
        return [
            'searchConsultations',
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
    public function searchAjax(?int $onlyMyPatients = 0)
    {
        $response = $this->_datatableService->getResults($onlyMyPatients);
        $this->RequestHandler->renderAs($this, 'json');
        $this->set(compact('response'));
        $this->set('_serialize', 'response');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void|null
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
     * @param int|null $id id.
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
        $this->request->allowMethod(['post', 'delete']);
        $this->RequestHandler->renderAs($this,'json');
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
        $response = $this->_formService
            ->getAutocomplete();

        $this->RequestHandler->renderAs($this, 'json');
        $this->set(compact('response'));
        $this->set('_serialize', 'response');
    }

    /**
     * Search Consultations Ajax method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function searchConsultations($id)
    {
        $consultationsDatatablesService = new ConsultationsDatatablesService($this);
        $response = $consultationsDatatablesService->getResults(intval($id));
        $this->RequestHandler->renderAs($this, 'json');
        $this->set(compact('response'));
        $this->set('_serialize', 'response');
    }

    /**
     * Save Consultation method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function consultationSave()
    {
        $this->RequestHandler->renderAs($this, 'json');
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            try {
                $consultationManagerService = new ConsultationsManagerService($this);
                if ($this->request->getData('consultation.id')) {
                    $consultationManagerService->setId(intval($this->request->getData('consultation.id')));
                }
                $response = $consultationManagerService->saveEntity($this->request->getData('consultation'));
            } catch (ValidationErrorException $ex) {
                $code = $ex->getCode() != 0? $ex->getCode() : 403;
                $this->response = $this->response->withStatus($code);
                $response['data'] = $ex->getEntity();
                $response['message'] = $ex->getMessage();
                $response['errors'] = $ex->getEntity()->getErrors();
            }
            $this->set(compact('response'));
            $this->set('_serialize', 'response');
        }
    }

    /**
     * search only Your Patients method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function searchOnlyYourPatients()
    {
    }

    /**
     * Edit method
     *
     * @param int|null $id id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editOnlyYourPatients(int $id = null)
    {
        $this->_formService->setId($id);
        $entity = $this->_formService->getEntity();
        try {
            $this->_formService->verifyPatientSpecialistLogged($entity);
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
        } catch (\Exception $ex) {
            $this->Flash->error($ex->getMessage());
            return $this->redirect(['action' => 'searchOnlyYourPatients']);
        }
        $this->set(compact('entity'));
        $this->render('edit');
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteOnlyYourPatients($ids)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->RequestHandler->renderAs($this,'json');
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
}
