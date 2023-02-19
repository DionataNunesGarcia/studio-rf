<?php

namespace App\Services\Manager;

use App\Error\Exception\ValidationErrorException;
use App\Model\Entity\Contact;
use App\Model\Entity\ContactsNewsletter;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

class ContactsManagerService extends ManagerService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Contacts');
        parent::__construct($controller);
    }

    /**
     * @return array
     */
    public function saveEntity() :array
    {
        /** @var Contact $entity */
        $entity = $this->__table
            ->patchEntity($this->getEntity(), $this->_request->getData());

        if (!$this->__table->save($entity)) {
            throw new ValidationErrorException($entity);
        }
        $this->sendEmail($entity->email, $entity->subject, html_entity_decode($entity->message));
        $this->response['data'] = $entity;
        $this->response['ok'] = 'ok';
        return $this->response;
    }
}
