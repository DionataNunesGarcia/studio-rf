<?php

namespace App\Services\Form;

use App\Services\DefaultService;
use App\Utils\Enum\HttpStatusCodeEnum;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\Http\Exception\NotFoundException;
use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class ClientsFormService extends DefaultService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Clients');
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
}