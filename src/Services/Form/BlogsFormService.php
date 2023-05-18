<?php

namespace App\Services\Form;

use App\Services\DefaultService;
use App\Utils\Enum\HttpStatusCodeEnum;
use App\Utils\Enum\StatusEnum;
use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class BlogsFormService extends DefaultService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Blogs');
        parent::__construct($controller);
    }

    /**
     * @param bool $own
     * @return Entity
     * @throws \Exception
     */
    public function getEntity(bool $onlyOwn = false) :Entity
    {
        $id = $this->getId() ?? null;
        $entity = $this->__table
            ->getEntity($id);
        if ($onlyOwn && $entity->user_id != $this->_userSession['id']) {
            throw new \Exception('Esse conteúdo não pertence a você.', HttpStatusCodeEnum::NOT_ACCEPTABLE);
        }
        return $entity;
    }

    /**
     * @return array
     */
    public function getAutocomplete() :array
    {
        $conditions["{$this->getModel()}.status !="] = StatusEnum::EXCLUDED;
        if ($this->_request->getQuery('id')) {
            //if load the id, get then
            $conditions["{$this->getModel()}.id IN"] = explode(',',$this->_request->getQuery('id'));
        }
        if (!empty($this->_request->getQuery('term'))) {
            //se pesquisar, busca pelo termo
            $conditions["upper({$this->getModel()}.title) like"] = '%' . strtoupper($this->_request->getQuery('term')) . '%';
            $conditions["upper({$this->getModel()}.subtitle) like"] = '%' . strtoupper($this->_request->getQuery('term')) . '%';
        }
        return  $this->__table
            ->find('list', [
                'keyField' => function($q){},
                'valueField' => function($q){
                    return [
                        'id' => $q->id,
                        'value' => "{$q->title}"
                    ];
                },
            ])
            ->where($conditions)
            ->limit($this->autocompleteLimit)
            ->toArray();
    }

    /**
     * @param int $limit
     * @param int|null $ignoreId
     * @param string|NULL $ignoreCategory
     * @return array
     */
    public function getLatestPosts(int $limit = 4, ?int $ignoreId = NULL, string $ignoreCategory = NULL) :array
    {
        $conditions = self::getConditionsFront();
        if ($ignoreId) {
            $conditions['Blogs.id !='] = $ignoreId;
        }
        if ($ignoreCategory) {
            $conditions['BlogsCategories.slug !='] = $ignoreCategory;
        }
        return $this->getByConditions($conditions, $limit);
    }

    /**
     * @param int $limit
     * @param string $category
     * @return array
     */
    public function getOnlyCategory(string $category, int $limit = 4) :array
    {
        $conditions = self::getConditionsFront();
        $conditions['BlogsCategories.slug !='] = $category;
        return $this->getByConditions($conditions, $limit);
    }

    /**
     * @param array $conditions
     * @param int $limit
     * @return array
     */
    public function getByConditions(array $conditions, int $limit = 4) :array
    {
        return $this->__table
            ->find()
            ->where($conditions)
            ->contain([
                'BlogsCategories',
                'Cover',
                'Users',
            ])
            ->limit($limit)
            ->orderDesc('Blogs.created')
            ->group('Blogs.id')
            ->toArray();
    }

    /**
     * @param string|null $category
     * @return \Cake\ORM\Query
     */
    public function getListPaginate(string $category = null) :Query
    {
        $query = $this->__table
            ->find()
            ->contain([
                'BlogsCategories',
                'Cover',
                'Tags',
                'Users',
            ]);
        $conditions = self::getConditionsFront();
        if ($this->_request->getQuery('search')) {
            $search = $this->_request->getQuery('search');
            $conditions['or']['upper(Blogs.title) like'] = "%$search%";
            $conditions['or']['upper(Blogs.content) like'] = "%$search%";
        }
        if ($this->_request->getQuery('tag')) {
            $tag = $this->_request->getQuery('tag');
            $query
                ->matching('Tags', function(\Cake\ORM\Query $q) use ($tag) {
                    return $q
                        ->where([
                            'lower(Tags.slug)' => strtolower(trim($tag)),
                        ]);
                });
        }
        if ($category) {
            $conditions['BlogsCategories.slug'] = trim($category);
        }
        return $query
            ->where($conditions)
            ->orderDesc('Blogs.created')
            ->group('Blogs.id');
    }

    private static function getConditionsFront() :array
    {
        return [
            'Blogs.status !=' => StatusEnum::EXCLUDED,
            'Blogs.show_website' => true
        ];
    }
}
