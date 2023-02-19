<?php

namespace App\Services\Manager;

use App\Error\Exception\ValidationErrorException;
use App\Model\Entity\Specialist;
use App\Model\Entity\User;
use App\Services\DefaultService;
use App\Utils\Enum\HttpStatusCodeEnum;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

class SpecialistsManagerService extends ManagerService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Specialists');
        parent::__construct($controller);
    }

    /**
     * @return array
     */
    public function saveEntity() :array
    {
        $this->connection->begin();
        /** @var Specialist $entity */
        $entity = $this->__table
            ->patchEntity($this->getEntity(), $this->_request->getData());

        $entity->user = $this->saveUser($entity);
        $entity->user_id = $entity->user->id;

        if (!$this->__table->save($entity)) {
            $this->connection->rollback();
            throw new ValidationErrorException($entity);
        }

        $this->response['data'] = $entity;
        $this->connection->commit();
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

    /**
     * @param Specialist $entity
     * @return void
     */
    public function saveUser(Specialist $entity)
    {
        $user = $this->buildUser($entity);
        $this->validateUniqueField($user, 'user', false, 'Users');
        $this->validateUniqueField($user, 'email', false, 'Users');
        if (!self::getTableLocator('Users')->save($user)) {
            $this->connection->rollback();
            throw new ValidationErrorException($user, "Erro ao salvar o usuário {$user->name}");
        }
        $this->saveUploadTemp($user->id, 'Users');
        return $user;
    }

    private function buildUser(Specialist $entity) :User
    {
        $data = $this->_request->getData('user');
        if (!$data) {
            throw new ValidationErrorException($entity, "Não existe dados do usuário para salvar");
        }
        /** @var User $user */
        $user = self::getTableLocator('Users')
            ->getEntity($entity->user_id);
        if (!empty($data['password'])) {
            $user->password = $data['password'];
        }
        $user->name = $entity->name;
        $user->email = $entity->email;
        $user->phone = $entity->phone;
        $user->cell_phone = $entity->cell_phone;
        $user->user = $data['user'];
        $user->level_id = $data['level_id'];
        $user->status = $data['status'];
        if ($user->isNew()) {
            $user->created = FrozenTime::now();
        }
        $user->modified = FrozenTime::now();
        return $user;
    }
}
