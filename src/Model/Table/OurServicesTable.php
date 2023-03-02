<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * OurServices Model
 *
 * @method \App\Model\Entity\OurService newEmptyEntity()
 * @method \App\Model\Entity\OurService newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\OurService[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OurService get($primaryKey, $options = [])
 * @method \App\Model\Entity\OurService findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\OurService patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OurService[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OurService|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OurService saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OurService[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OurService[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\OurService[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\OurService[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OurServicesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('our_services');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Icon', [
            'className' => 'Uploads',
            'foreignKey' => [
                'foreign_key'
            ],
            'joinType' => 'LEFT',
            'conditions' => [
                'Icon.model' => 'OurServices',
            ],
        ]);
        $this->hasMany('Gallery', [
            'className' => 'Uploads',
            'foreignKey' => [
                'foreign_key'
            ],
            'joinType' => 'LEFT',
            'conditions' => [
                'Gallery.model' => 'GalleryServices',
            ],
        ]);

        $this->addBehavior('RegisterLogChange');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        $validator
            ->scalar('content')
            ->maxLength('content', 4294967295)
            ->requirePresence('content', 'create')
            ->notEmptyString('content');

        return $validator;
    }

    /**
     * @param Event $event
     * @param \ArrayObject $data
     * @param \ArrayObject $options
     * @return void
     */
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        if (isset($data['name'])) {
            $data['slug'] = strtolower(Text::slug($data['name']));
        }
        if (isset($data['content'])) {
            $data['content'] = trim(utf8_encode($data['content']));
        }
    }

    /**
     * @param int|null $id
     * @return Entity
     */
    public function getEntity(int $id = null) :Entity
    {
        if ($id) {
            return $this
                ->get($id, [
                    'contain' => [
                        "Icon",
                        "Gallery",
                    ]
                ]);
        }
        return $this->newEmptyEntity();
    }
}
