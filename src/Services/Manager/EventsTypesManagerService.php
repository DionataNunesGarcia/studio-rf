<?php

namespace App\Services\Manager;

use App\Error\Exception\ValidationErrorException;
use App\Model\Entity\EventsType;
use App\Model\Table\LevelsPermissionsTable;
use App\Model\Table\LevelsTable;
use App\Services\DefaultService;
use App\Utils\Enum\HttpStatusCodeEnum;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;

class EventsTypesManagerService extends ManagerService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('EventsTypes');
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

    /**
     * @return array
     * @throws \Exception
     */
    public function saveCustom() :array
    {
        /** @var EventsType $entity */
        $entity = $this->getEntity();

        $entity->user_id = $this->_userSession['id'];
        $entity->name = $this->_request->getData('name');
        $entity->slug = Text::slug($entity->name);
        $entity->color = $this->_request->getData('color');
        $entity->status = StatusEnum::ACTIVE;
        $entity->deletable = true;
        $entity->created = FrozenTime::now();
        $entity->modified = FrozenTime::now();

        if (!$this->__table->save($entity)) {
            throw new \Exception('Erro ao salvar o evento', HttpStatusCodeEnum::BAD_GATEWAY);
        }
        $this->response['data'] = $entity;
        return $this->response;
    }
}
