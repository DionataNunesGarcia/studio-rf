<?php

namespace App\Services\Form;

use App\Services\DefaultService;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;

class TagsFormService extends DefaultService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Tags');
        parent::__construct($controller);
    }

    /**
     * @return array
     */
    public function getList() :array
    {
        $conditions = self::getConditionsFront();
        return $this->__table
            ->find()
            ->where($conditions)
            ->matching('TagsModels', function(\Cake\ORM\Query $q) {
                return $q
                    ->where([
                        'TagsModels.tag_id IS NOT' => NULL,
                    ]);
            })
            ->group('Tags.id')
            ->toArray();
    }

    /**
     * @return array
     */
    private static function getConditionsFront() :array
    {
        return [
            "Tags.status !=" => StatusEnum::EXCLUDED,
        ];
    }
}
