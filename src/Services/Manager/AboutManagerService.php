<?php

namespace App\Services\Manager;

use App\Error\Exception\ValidationErrorException;
use Cake\Controller\Controller;

class AboutManagerService extends ManagerService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('About');
        parent::__construct($controller);
    }

    /**
     * @return array
     */
    public function saveEntity() :array
    {
        $entity = $this->__table
            ->patchEntity($this->getEntity(), $this->_request->getData());
        if (!$this->__table->save($entity)) {
            throw new ValidationErrorException($entity);
        }
        $this->saveAddress($entity->id, $this->getModel());
        $this->saveUploadTemp($entity->id);
        $this->response['data'] = $entity;
        return $this->response;
    }
}
