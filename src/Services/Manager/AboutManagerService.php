<?php

namespace App\Services\Manager;

use App\Error\Exception\ValidationErrorException;
use App\Model\Entity\SlidesHome;
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
        $this->saveSlidesHome();
        $this->response['data'] = $entity;
        return $this->response;
    }

    private function saveSlidesHome()
    {
        $table = self::getTableLocator('SlidesHome');
        $table->deleteAll([]);
        if ($this->_request->getData('slide_home')) {
            $slides = $this->_request->getData('slide_home');
            foreach ($slides['title'] as $key => $title) {
                /** @var SlidesHome $entity */
                $entity = $table->newEmptyEntity();
                $entity->title = $title;
                $entity->subtitle = $slides['subtitle'][$key];
                $table->save($entity);
            }
        }
    }
}
