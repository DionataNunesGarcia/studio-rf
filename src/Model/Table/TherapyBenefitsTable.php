<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * TherapyBenefits Model
 *
 * @method \App\Model\Entity\TherapyBenefit newEmptyEntity()
 * @method \App\Model\Entity\TherapyBenefit newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TherapyBenefit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TherapyBenefit get($primaryKey, $options = [])
 * @method \App\Model\Entity\TherapyBenefit findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TherapyBenefit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TherapyBenefit[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TherapyBenefit|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TherapyBenefit saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TherapyBenefit[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TherapyBenefit[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TherapyBenefit[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TherapyBenefit[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TherapyBenefitsTable extends Table
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

        $this->setTable('therapy_benefits');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('subtitle')
            ->maxLength('subtitle', 255)
            ->requirePresence('subtitle', 'create')
            ->notEmptyString('subtitle');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

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
        if (isset($data['title'])) {
            $data['slug'] = strtolower(Text::slug($data['title']));
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
            return $this->get($id);
        }
        return $this->newEmptyEntity();
    }
}
