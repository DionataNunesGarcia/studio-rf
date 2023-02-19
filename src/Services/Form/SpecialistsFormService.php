<?php

namespace App\Services\Form;

use App\Services\DefaultService;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class SpecialistsFormService extends DefaultService
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
            "Specialists.status !=" => StatusEnum::EXCLUDED,
        ];
    }
}
