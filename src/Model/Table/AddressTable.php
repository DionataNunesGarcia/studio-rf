<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Utils\ConvertCharacters;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Address Model
 *
 * @method \App\Model\Entity\Addres newEmptyEntity()
 * @method \App\Model\Entity\Addres newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Addres[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Addres get($primaryKey, $options = [])
 * @method \App\Model\Entity\Addres findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Addres patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Addres[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Addres|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Addres saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Addres[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Addres[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Addres[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Addres[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AddressTable extends Table
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

        $this->setTable('address');
        $this->setDisplayField('id');
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
            ->scalar('cep')
            ->maxLength('cep', 15)
            ->allowEmptyString('cep');

        $validator
            ->scalar('street')
            ->maxLength('street', 255)
            ->allowEmptyString('street');

        $validator
            ->scalar('number')
            ->maxLength('number', 45)
            ->allowEmptyString('number');

        $validator
            ->scalar('district')
            ->maxLength('district', 255)
            ->allowEmptyString('district');

        $validator
            ->scalar('complement')
            ->maxLength('complement', 255)
            ->allowEmptyString('complement');

        $validator
            ->scalar('lat')
            ->maxLength('lat', 255)
            ->allowEmptyString('lat');

        $validator
            ->scalar('long')
            ->maxLength('long', 255)
            ->allowEmptyString('long');

        $validator
            ->scalar('city')
            ->maxLength('city', 255)
            ->allowEmptyString('city');

        $validator
            ->scalar('uf')
            ->maxLength('uf', 2)
            ->allowEmptyString('uf');

        $validator
            ->integer('foreign_key')
            ->requirePresence('foreign_key', 'create')
            ->notEmptyString('foreign_key');

        $validator
            ->scalar('model')
            ->maxLength('model', 255)
            ->requirePresence('model', 'create')
            ->notEmptyString('model');

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
        if (!empty($data['cep'])) {
            $data['cep'] = ConvertCharacters::onlyNumbers($data['cep']);
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
