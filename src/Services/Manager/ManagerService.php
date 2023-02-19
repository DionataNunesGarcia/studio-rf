<?php

namespace App\Services\Manager;

use App\Error\Exception\ValidationErrorException;
use App\Model\Entity\Addres;
use App\Model\Entity\Event;
use App\Services\DefaultService;
use App\Utils\Enum\EventsStatusEnum;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;
use Cake\ORM\Entity;
use Cake\Utility\Text;
use Laminas\Diactoros\UploadedFile;

class ManagerService extends DefaultService
{
    /**
     * @var ConnectionManager
     */
    protected $connection;

    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        parent::__construct($controller);
        $this->connection = ConnectionManager::get('default');
    }

    /**
     * @param string $emailTo
     * @param string $subject
     * @param string $message
     * @param string|NULL $from
     * @return void
     */
    public function sendEmail(string $emailTo, string $subject, string $message, string $from = NULL) :void
    {
        $client = Configure::read('Client');
        if (empty($from)) {
            $from = $client['email'];
        }

        $mailer = new Mailer('default');
        $mailer
            ->setFrom([$from => "{$client['name']}"])
            ->setEmailFormat('html')
            ->setTo($emailTo)
            ->setSubject($subject)
            ->deliver($message);
    }

    /**
     * @param Entity $entity
     * @param string $field
     * @param bool $exception
     * @param string|null $modelName
     * @return bool
     */
    protected function validateUniqueField(Entity $entity, string $field, bool $exception = true, string $modelName = null) :bool
    {
        if (!$modelName) {
            $modelName = $this->getModel();
        }
        $id = $entity->isNew() ? 0 : $entity->id;
        $value = $entity->{$field};
        $exist = self::getTableLocator($modelName)
            ->exists([
                $field => $value,
                'id !=' => $id,
            ]);
        if ($exist && $exception) {
            throw new ValidationErrorException($entity, "O campo {$field} já existe com o valor {$value}, não pode ser cadastrado duplicado.");
        }
        return $exist;
    }

    /**
     * @param string $temp
     * @param UploadedFile $file
     * @return UploadedFile
     */
    protected function buildTempFile(string $temp, UploadedFile $file) :UploadedFile
    {
        return new UploadedFile(
            $temp,
            filesize($temp),
            $file->getError(),
            $file->getClientFilename(),
            $file->getClientMediaType()
        );
    }

    /**
     * @param int $entityId
     * @param string|null $model
     * @return void
     */
    public function saveUploadTemp(int $entityId, string $model = null)
    {
        if (!$model) {
            $model = $this->getModel();
        }
        $upload = $this->_request->getData('upload');
        /** @var UploadedFile $file */
        $file = $upload['file'];
        if (isset($upload['image_upload_temp']) && $file) {
            $file = $this->buildTempFile($upload['image_upload_temp'], $file);
        }
        $uploadsManagerService = new UploadsManagerService($this->_controller);
        $uploadsManagerService->saveFile(
            $file,
            $entityId,
            $model
        );
    }

    /**
     * @param int $foreignKey
     * @param string $model
     * @return void
     */
    protected function saveAddress(int $foreignKey, string $model)
    {
        if ($this->_request->getData('address')) {
            $addressTable = self::getTableLocator('Address');
            $data = $this->_request->getData('address');
            $addressId = $data['id'] ? intval($data['id']) : null;
            /** @var Addres $entity */
            $entity = $addressTable
                ->patchEntity($addressTable->getEntity($addressId), $data);

            $entity->model = $model;
            $entity->foreign_key = $foreignKey;

            if (!$addressTable->save($entity)) {
                throw new ValidationErrorException($entity, "Erro ao salvar o endereço");
            }
        }
    }

    /**
     * @param string $title
     * @param int $foreignKey
     * @param string $eventTypeSlug
     * @param string $start
     * @param string|null $end
     * @param string|null $model
     * @return void
     */
    protected function registerEvent(string $title, int $foreignKey, string $eventTypeSlug, string $start, string $end = null, string $model = null)
    {
        $model = $model ?? $this->getModel();
        $eventType = $this->getEventType($eventTypeSlug);
        $entity = $this->getEventEntity($foreignKey, $model);
        $entity->title = $title;
        $entity->slug = strtolower(Text::slug($title));;
        $entity->all_day = false;
        $entity->start = $start;
        $entity->end = $end;
        $entity->event_type_id = $eventType->id;
        $entity->details = '';
        $entity->event_status = EventsStatusEnum::SCHEDULED;
        $entity->status = StatusEnum::ACTIVE;
        $entity->user_id = $this->_userSession['id'];
        if (!self::getTableLocator('Events')->save($entity)) {
            throw new ValidationErrorException($entity, "Erro ao salvar o Evento no calendario");
        }
    }

    /**
     * @param string $foreignKey
     * @param string $model
     * @return Event
     */
    private function getEventEntity(string $foreignKey, string $model) :Event
    {
        $table = self::getTableLocator('Events');
        $entity = $table
            ->find()
            ->where([
                'foreign_key' => $foreignKey,
                'model' => $model,
            ])
            ->first();
        /** @var Event $entity */
        if (!$entity) {
            $entity = $table->newEmptyEntity();
            $entity->foreign_key = $foreignKey;
            $entity->model = $model;
            $entity->created = FrozenTime::now();
        }
        $entity->modified = FrozenTime::now();
        return $entity;
    }

    /**
     * @param string $slug
     * @return array|\Cake\Datasource\EntityInterface|null
     */
    private function getEventType(string $slug)
    {
        return self::getTableLocator('EventsTypes')
            ->find()
            ->where(['slug' => $slug])
            ->first();
    }
}
