<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\Error\Exception\ValidationErrorException;
use App\Model\Entity\Blog;
use App\Services\Form\BlogsCategoriesFormService;
use App\Services\Form\BlogsFormService;
use App\Services\Form\OurServicesFormService;
use App\Services\Form\TagsFormService;
use App\Services\Form\TestimonialsFormService;
use App\Services\Form\TherapyBenefitsFormService;
use App\Services\Manager\ContactsManagerService;
use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * @var BlogsFormService $_blogsFormService
     */
    private BlogsFormService $_blogsFormService;

    /**
     * @var BlogsCategoriesFormService $_blogsCategoriesFormService
     */
    private BlogsCategoriesFormService $_blogsCategoriesFormService;

    /**
     * @var OurServicesFormService $_ourServicesFormService
     */
    private OurServicesFormService $_ourServicesFormService;

    /**
     * @var TestimonialsFormService $_testimonialsFormService
     */
    private TestimonialsFormService $_testimonialsFormService;

    /**
     * @var ContactsManagerService $_contactsManagerService
     */
    private ContactsManagerService $_contactsManagerService;

    /**
     * @var TherapyBenefitsFormService $_benefitsFormService
     */
    private TherapyBenefitsFormService $_benefitsFormService;

    /**
     * @var TagsFormService $_tagsFormService
     */
    private TagsFormService $_tagsFormService;

    public function initialize(): void
    {
        parent::initialize();

        $this->_blogsFormService = new BlogsFormService($this);
        $this->_blogsCategoriesFormService = new BlogsCategoriesFormService($this);
        $this->_ourServicesFormService = new OurServicesFormService($this);
        $this->_testimonialsFormService = new TestimonialsFormService($this);
        $this->_contactsManagerService = new ContactsManagerService($this);
        $this->_tagsFormService = new TagsFormService($this);
    }

    /**
     * @param EventInterface $event
     * @return string
     */
    public function beforeFilter(EventInterface $event)
    {
        $this->viewBuilder()->setLayout('front');
        $categories = $this->_blogsCategoriesFormService->getListShowWebsite();
        $this->set(compact(
            'categories'
        ));
    }

    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    /**
     * @return void
     */
    public function home()
    {
        $blogs = $this->_blogsFormService->getLatestPosts();
        $ourServices = $this->_ourServicesFormService->getList();

        $this->set(compact(
            'blogs',
            'ourServices'
        ));
    }

    public function about()
    {
        $benefits = $this->_benefitsFormService->getList();
        $this->set(compact(
            'benefits',
        ));
    }

    public function services()
    {
        $ourServices = $this->_ourServicesFormService
            ->getListFront();

        $testimonials = $this->_testimonialsFormService
            ->getListFront();

        $this->set(compact('ourServices', 'testimonials'));
    }

    public function contents($category = null)
    {
        $query = $this->_blogsFormService
            ->getListPaginate($category);

        $this->paginate = [
            'limit' => 9,
        ];
        $blogs = $this->paginate(
            $query
        );

        $latestBlogs = $this->_blogsFormService->getLatestPosts(5);
        $tags = $this->_tagsFormService->getList();

        $this->set(compact(
            'blogs',
            'latestBlogs',
            'tags'
        ));
    }

    public function content($id = null, $slug = null)
    {
        $this->_blogsFormService->setId(intval($id));
        $blog = $this->_blogsFormService->getEntity();

        $latestBlogs = $this->_blogsFormService->getLatestPosts(5, intval($id));
        $tags = $this->_tagsFormService->getList();

        $this->set(compact(
            'blog',
            'latestBlogs',
            'tags'
        ));
    }

    public function contact()
    {
    }

    public function saveContact()
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $this->RequestHandler->renderAs($this,'json');
        try {
            $response = $this->_contactsManagerService->saveEntity();
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
