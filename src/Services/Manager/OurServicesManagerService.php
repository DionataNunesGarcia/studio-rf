<?php

namespace App\Services\Manager;

use App\Error\Exception\ValidationErrorException;
use App\Utils\Enum\HttpStatusCodeEnum;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;

class OurServicesManagerService extends ManagerService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('OurServices');
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

        $this->saveUploadTemp($entity->id);

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

        foreach ($entities as $entity) {
            $entity->status = StatusEnum::EXCLUDED;
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
