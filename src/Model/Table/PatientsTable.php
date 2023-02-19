<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Utils\ConvertCharacters;
use App\Utils\ConvertDates;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Patients Model
 *
 * @property \App\Model\Table\SpecialistsTable&\Cake\ORM\Association\BelongsTo $Specialists
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Patient newEmptyEntity()
 * @method \App\Model\Entity\Patient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Patient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Patient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Patient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Patient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Patient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Patient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Patient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PatientsTable extends Table
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

        $this->setTable('patients');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Specialists', [
            'foreignKey' => 'specialist_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasOne('Address', [
            'className' => 'Address',
            'propertyName' => 'address',
            'foreignKey' => [
                'foreign_key'
            ],
            'joinType' => 'LEFT',
            'conditions' => [
                'Address.model' => 'Patients',
            ],
        ]);

        $this->hasOne('Avatar', [
            'className' => 'Uploads',
            'foreignKey' => [
                'foreign_key'
            ],
            'joinType' => 'LEFT',
            'conditions' => [
                'Avatar.model' => 'Patients',
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
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('cpf')
            ->maxLength('cpf', 255)
            ->allowEmptyString('cpf');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 100)
            ->allowEmptyString('phone');

        $validator
            ->scalar('cell_phone')
            ->maxLength('cell_phone', 100)
            ->allowEmptyString('cell_phone');

        $validator
            ->date('birth_date')
            ->allowEmptyDate('birth_date');

        $validator
            ->decimal('query_value')
            ->requirePresence('query_value', 'create')
            ->notEmptyString('query_value');

        $validator
            ->scalar('observations')
            ->maxLength('observations', 4294967295)
            ->allowEmptyString('observations');

        $validator
            ->integer('specialist_id')
            ->requirePresence('specialist_id', 'create')
            ->notEmptyString('specialist_id');

        $validator
            ->integer('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmptyString('user_id');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('specialist_id', 'Specialists'), ['errorField' => 'specialist_id']);
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    /**
     * @param Event $event
     * @param \ArrayObject $data
     * @param \ArrayObject $options
     * @return void
     */
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        if (!empty($data['phone'])) {
            $data['phone'] = ConvertCharacters::onlyNumbers($data['phone']);
        }
        if (!empty($data['cell_phone'])) {
            $data['cell_phone'] = ConvertCharacters::onlyNumbers($data['cell_phone']);
        }
        if (!empty($data['cpf'])) {
            $data['cpf'] = ConvertCharacters::onlyNumbers($data['cpf']);
        }
        if (!empty($data['birth_date'])) {
            $data['birth_date'] = ConvertDates::convertOnlyDateToDB($data['birth_date']);
        }
        if (!empty($data['query_value'])) {
            $data['query_value'] = ConvertCharacters::stringToFloat($data['query_value']);
        }
        if (isset($data['observations'])) {
            $data['observations'] = trim(utf8_encode($data['observations']));
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
                        "Avatar",
                        "Address",
                    ]
                ]);
        }
        return $this->newEmptyEntity();
    }
}
