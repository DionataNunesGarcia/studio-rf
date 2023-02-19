<?php

namespace App\Services\Form;

use App\Model\Entity\User;
use App\Services\DefaultService;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;

class UsersFormService extends DefaultService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Users');
        parent::__construct($controller);
    }

    /**
     * @return array
     */
    public function getAutocomplete() :array
    {
        $query = $this->__table
            ->find('list', [
                'keyField' => function($q){},
                'valueField' => function($q){
                    return [
                        'id' => $q->id,
                        'value' => "{$q->user} - {$q->level->name}"
                    ];
                },
            ])
            ->where([
//                "{$this->getModel()}.super" => FALSE,
                "{$this->getModel()}.status !=" => StatusEnum::EXCLUDED,
            ])
            ->contain([
                'Levels'
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
                "upper({$this->getModel()}.user) like" => '%' . strtoupper($this->_request->getQuery('term')) . '%',
                "upper(Levels.user) like" => '%' . strtoupper($this->_request->getQuery('term')) . '%',
            ]);
        }
        return $query->toArray();
    }

    /**
     * @param int $userId
     * @return array|\Cake\Datasource\EntityInterface
     */
    public function buildUserLogged(int $userId)
    {
        return $this->__table
            ->find()
            ->where([
                "{$this->getModel()}.id" => $userId,
                "{$this->getModel()}.status" => StatusEnum::ACTIVE,
            ])
            ->contain([
                "Levels.LevelsPermissions",
                "Avatar",
                "Specialist",
            ])
            ->firstOrFail();
    }

}
