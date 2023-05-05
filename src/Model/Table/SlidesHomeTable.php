<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SlidesHome Model
 *
 * @method \App\Model\Entity\SlidesHome newEmptyEntity()
 * @method \App\Model\Entity\SlidesHome newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SlidesHome[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SlidesHome get($primaryKey, $options = [])
 * @method \App\Model\Entity\SlidesHome findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SlidesHome patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SlidesHome[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SlidesHome|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SlidesHome saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SlidesHome[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SlidesHome[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SlidesHome[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SlidesHome[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SlidesHomeTable extends Table
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

        $this->setTable('slides_home');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->allowEmptyString('title');

        $validator
            ->scalar('subtitle')
            ->maxLength('subtitle', 255)
            ->allowEmptyString('subtitle');

        return $validator;
    }
}
