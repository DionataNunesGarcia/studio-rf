<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Error\Exception\ValidationErrorException;
use App\Services\Form\UploadsFormService;
use App\Services\Manager\UploadsManagerService;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;

/**
 * Utils Controller
 *
 * @method \App\Model\Entity\Util[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UtilsController extends AdminController
{
    /**
     * @var UploadsFormService
     */
    private UploadsFormService $_uploadsFormService;

    /**
     * @var UploadsManagerService
     */
    private UploadsManagerService $_uploadsManagerService;

    /**
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->_uploadsFormService = new UploadsFormService($this);
        $this->_uploadsManagerService = new UploadsManagerService($this);
    }

    /**
     * @return string[]
     */
    public static function ignoreListActionsCustom() :array
    {
        return [
            'download',
            'multipleFileUploads',
            'multipleFileUploadsList',
            'multipleFileUploadsDelete',
        ];
    }

    /**
     * @return void
     */
    public function cropImageAjax() : void
    {
        $this->viewBuilder()->setLayout(null);

        if (empty($this->request->getData("image"))) {
            return;
        }
        $image = $this->request->getData("image");
        $imageName = $this->_uploadsManagerService->saveTemporaryFile($image);

        $this->set([
            'imageName' => $imageName,
            'image' => $image
        ]);
        $this->render('/Admin/element/admin/image-crop');
    }

    /**
     * @param int $id
     * @return \Cake\Http\Response
     */
    public function download(int $id) :\Cake\Http\Response
    {
        $this->_uploadsFormService->setId($id);
        $entity = $this->_uploadsFormService->getEntity();
        $filePath = WWW_ROOT . "Uploads" . DS . $entity->filename;
        $time = FrozenTime::now()->i18nFormat('yyyy-MM-dd-HH-mm-ss');
        $filename = str_replace(".$entity->extension", '', $entity->alt);

        return $this->response
            ->withFile($filePath, [
                'download' => true,
                'name' => "{$time} {$filename}.{$entity->extension}"
            ]);
    }

    /**
     * @return void
     */
    public function multipleFileUploads()
    {
        ini_set('post_max_size', '1024M');
        ini_set('upload_max_filesize', '1024M');
        $conn = ConnectionManager::get('default');
        $conn->begin();
        $this->RequestHandler->renderAs($this, 'json');
        $response = [];
        try {
            $this->request->allowMethod(['post']);
            $response = $this->_uploadsManagerService->saveUploads();
            $conn->commit();
        } catch (\Exception $ex) {
            $conn->rollback();
            $this->response = $this->response->withStatus($ex->getCode());
            $response['message'] = $ex->getMessage();
        }
        $this->set(compact('response'));
        $this->set('_serialize', 'response');
    }

    /**
     * @return void
     */
    public function multipleFileUploadsList()
    {
        $this->RequestHandler->renderAs($this, 'json');
        $response = [];
        try {
            $this->request->allowMethod(['get']);
            $data = $this->request->getQuery();
            $response['data'] = $this->_uploadsFormService->listFiles($data);
        } catch (\Exception $ex) {
            $this->response = $this->response->withStatus($ex->getCode());
            $response['message'] = $ex->getMessage();
        }
        $this->set(compact('response'));
        $this->set('_serialize', 'response');
    }

    /**
     * @return void
     */
    public function multipleFileUploadsDelete()
    {
        $conn = ConnectionManager::get('default');
        $conn->begin();
        $this->RequestHandler->renderAs($this, 'json');
        $response = [];
        try {
            $this->getRequest()->allowMethod(['post', 'delete']);
            $data = $this->getRequest()->getData();
            $response['data'] = $this->_uploadsManagerService->removeUploads(
                $data['foreignKeys'],
                $data['model']
            );
            $conn->commit();
        } catch (\Exception $ex) {
            $conn->rollback();
            $this->response = $this->response->withStatus($ex->getCode());
            $response['message'] = $ex->getMessage();
        }
        $this->set(compact('response'));
        $this->set('_serialize', 'response');
    }
}
