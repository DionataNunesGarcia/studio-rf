<?php

namespace App\Services\Manager;

use App\Error\Exception\ValidationErrorException;
use App\Model\Entity\Consultation;
use App\Services\DefaultService;
use App\Utils\ConvertDates;
use App\Utils\Enum\HttpStatusCodeEnum;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;

class ConsultationsManagerService extends ManagerService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Consultations');
        parent::__construct($controller);
    }

    /**
     * @param array $data
     * @return array
     */
    public function saveEntity(array $data) :array
    {
        $associated = [
            'associated' => ['Patients'],
        ];
        /** @var Consultation $entity */
        $entity = $this->__table
            ->patchEntity($this->getEntity(), $data, $associated);

        if ($entity->isNew()) {
            $entity->user_id = $this->_userSession['id'];
        }
        if (!$this->__table->save($entity, $associated)) {
            throw new ValidationErrorException($entity);
        }
        $this->eventSave($entity);
        $this->periodSave($entity);
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
     * @param Consultation $entity
     * @return void
     */
    private function periodSave(Consultation $entity)
    {
        if ($this->_request->getData('period.add') == '1') {
            $times = $this->_request->getData('period.time');
            $dates = $this->_request->getData('period.date');
            foreach ($dates as $key => $date) {
                /** @var Consultation $newEntity */
                $newEntity = $this->__table->newEmptyEntity();
                $newEntity->date = ConvertDates::convertDateTimeToDB("{$date} {$times[$key]}");
                $newEntity->patient_id = $entity->patient_id;
                $newEntity->specialist_id = $entity->specialist_id;
                $newEntity->value = $entity->value;
                $newEntity->user_id = $entity->user_id;
                $newEntity->description = $entity->description;
                $newEntity->amount_paid = $entity->amount_paid;
                $newEntity->date_paid = $entity->date_paid;
                if (!$this->__table->save($newEntity)) {
                    throw new ValidationErrorException($newEntity);
                }
                $this->eventSave($newEntity);
            }
        }
    }

    /**
     * @param Consultation $entity
     * @return void
     */
    private function eventSave(Consultation $entity)
    {
        /** @var Consultation $entityFull */
        $entityFull = $this->__table->getEntity($entity->id);

        $this->registerEvent(
            "Atendimento: {$entityFull->patient->name} - {$entityFull->patient->email}",
            $entityFull->id,
            'consultations',
            $entityFull->date->i18nFormat('yyyy-MM-dd HH-mm')
        );
    }
}
