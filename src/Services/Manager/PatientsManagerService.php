<?php

namespace App\Services\Manager;

use App\Error\Exception\ValidationErrorException;
use App\Services\DefaultService;
use App\Services\Form\PatientsFormService;
use App\Utils\Enum\HttpStatusCodeEnum;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;

class PatientsManagerService extends ManagerService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Patients');
        parent::__construct($controller);
    }

    /**
     * @return array
     */
    public function saveEntity() :array
    {
        $entity = $this->__table
            ->patchEntity($this->getEntity(), $this->_request->getData());

        if ($entity->isNew()) {
            $entity->user_id = $this->_userSession['id'];
        }
        if (!$this->__table->save($entity)) {
            throw new ValidationErrorException($entity);
        }

        $this->saveUploadTemp($entity->id);
        $this->saveAddress($entity->id, $this->getModel());

        $this->response['data'] = $entity;
        return $this->response;
    }

    /**
     * @param string $ids
     * @return array
     * @throws \Exception
     */
    public function deletedEntities(string $ids) :array
    {
        $ids = explode(',', $ids);
        if (empty($ids)) {
            throw new \Exception("Nenhum registro foi selecionado", HttpStatusCodeEnum::BAD_REQUEST);
        }

        $entities = $this->__table
            ->find()
            ->where([
                'id IN'  => $ids,
            ])
            ->toArray();
        $formService = new PatientsFormService($this->_controller);

        foreach ($entities as $entity) {
            $formService->verifyPatientSpecialistLogged($entity);
            $entity->status = StatusEnum::EXCLUDED;
            $entity->name = "#del-{$entity->id}#{$entity->name}";
            $entity->email = "#del-{$entity->id}#{$entity->email}";
            $entity->cpf = "#del-{$entity->id}";
            $entity->modified = FrozenTime::now();
            if (!$this->__table->save($entity)) {
                throw new ValidationErrorException($entity, "Erro ao deletar o registro {$entity->name}");
            }
        }
        $this->response['data'] = $entities;
        $this->response['status'] = HttpStatusCodeEnum::RESET_CONTENT;
        return $this->response;
    }
}
