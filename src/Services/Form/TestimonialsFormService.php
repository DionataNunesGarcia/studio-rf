<?php

namespace App\Services\Form;

use App\Services\DefaultService;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class TestimonialsFormService extends DefaultService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Testimonials');
        parent::__construct($controller);
    }

    public function getAutocomplete() :array
    {
        $query = $this->__table
            ->find('list', [
                'keyField' => function($q){},
                'valueField' => function($q){
                    return [
                        'id' => $q->id,
                        'value' => "{$q->name}"
                    ];
                },
            ])
            ->where([
                "{$this->getModel()}.status !=" => StatusEnum::EXCLUDED
            ])
            ->limit($this->autocompleteLimit);

        if ($this->_request->getQuery('id')) {
            //if load the id, get then
            $query->where([
                "{$this->getModel()}.id in " => explode(',',$this->_request->getQuery('id'))
            ]);
        } else if (!empty($this->_request->getQuery('term'))) {
            //se pesquisar, busca pelo termo
            $query->where([
                "upper({$this->getModel()}.name) like" => '%' . strtoupper($this->_request->getQuery('term')) . '%',
            ]);
        }
        return $query->toArray();
    }

    /**
     * @param int $limit
     * @return Query
     */
    public function getListFront(int $limit = 5) :Query
    {
        return $this->__table
            ->find()
            ->where(self::getConditionsFront())
            ->contain([
                'Avatar',
            ])
            ->orderDesc("{$this->getModel()}.created")
            ->group("{$this->getModel()}.id")
            ->limit($limit);
    }

    /**
     * @return array
     */
    private static function getConditionsFront() :array
    {
        return [
            "Testimonials.status !=" => StatusEnum::EXCLUDED,
        ];
    }
}
