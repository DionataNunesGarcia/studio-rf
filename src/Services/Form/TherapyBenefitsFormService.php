<?php

namespace App\Services\Form;

use App\Services\DefaultService;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;

class TherapyBenefitsFormService extends DefaultService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('TherapyBenefits');
        parent::__construct($controller);
    }

    /**
     * @return array
     */
    public function getAutocomplete() :array
    {
        $conditions["{$this->getModel()}.status !="] = StatusEnum::EXCLUDED;
        //if load the id, get then
        if ($this->_request->getQuery('id')) {
            $conditions["{$this->getModel()}.id IN"] = explode(',',$this->_request->getQuery('id'));
        }
        //if is search, get by term
        if (!empty($this->_request->getQuery('term'))) {
            $conditions["upper({$this->getModel()}.title) like"] = '%' . strtoupper($this->_request->getQuery('term')) . '%';
        }
        return $this->__table
            ->find('list', [
                'keyField' => function($q){},
                'valueField' => function($q){
                    return [
                        'id' => $q->id,
                        'value' => $q->name
                    ];
                },
            ])
            ->where($conditions)
            ->limit($this->autocompleteLimit)
            ->toArray();
    }

    /**
     * @return array
     */
    public function getList() :array
    {
        return $this->__table
            ->find()
            ->where([
                'status !=' => StatusEnum::EXCLUDED,
            ])
            ->toArray();
    }
}
