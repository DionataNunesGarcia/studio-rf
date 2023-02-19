<?php

namespace App\Services\Form;

use App\Error\Exception\ValidationErrorException;
use App\Model\Entity\Patient;
use App\Services\DefaultService;
use App\Utils\Enum\HttpStatusCodeEnum;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class PatientsFormService extends DefaultService
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
     * @return \Cake\ORM\Query
     */
    public function getListFront() :Query
    {
        return $this->__table
            ->find()
            ->where(self::getConditionsFront())
            ->contain([
                'Avatar',
            ])
            ->orderDesc("{$this->getModel()}.created")
            ->group("{$this->getModel()}.id")
            ->limit(5);
    }

    /**
     * @return array
     */
    private static function getConditionsFront() :array
    {
        return [
            "Patients.status !=" => StatusEnum::EXCLUDED,
        ];
    }

    /**
     * @param Patient $entity
     * @return void
     * @throws \Exception
     */
    public function verifyPatientSpecialistLogged(Patient $entity)
    {
        if (!$this->_userSession['specialist']) {
            throw new \Exception('Usuário não é um Especialista cadastrado.', HttpStatusCodeEnum::BAD_REQUEST);
        }
        if ( $this->_userSession['specialist']['id'] != $entity->specialist_id) {
            throw new \Exception('Este paciente não pertence a você..', HttpStatusCodeEnum::BAD_REQUEST);
        }
    }
}
