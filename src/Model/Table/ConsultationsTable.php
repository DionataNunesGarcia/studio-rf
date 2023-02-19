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
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Consultations Model
 *
 * @property \App\Model\Table\PatientsTable&\Cake\ORM\Association\BelongsTo $Patients
 * @property \App\Model\Table\SpecialistsTable&\Cake\ORM\Association\BelongsTo $Specialists
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Consultation newEmptyEntity()
 * @method \App\Model\Entity\Consultation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Consultation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Consultation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Consultation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Consultation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Consultation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Consultation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Consultation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Consultation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Consultation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Consultation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Consultation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ConsultationsTable extends Table
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

        $this->setTable('consultations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Patients', [
            'foreignKey' => 'patient_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Specialists', [
            'foreignKey' => 'specialist_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
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
            ->integer('patient_id')
            ->requirePresence('patient_id', 'create')
            ->notEmptyString('patient_id');

        $validator
            ->integer('specialist_id')
            ->requirePresence('specialist_id', 'create')
            ->notEmptyString('specialist_id');

        $validator
            ->integer('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmptyString('user_id');

        $validator
            ->scalar('description')
            ->maxLength('description', 4294967295)
            ->allowEmptyDateTime('date');

        $validator
            ->dateTime('date')
            ->allowEmptyDateTime('date');

        $validator
            ->decimal('value')
            ->requirePresence('value', 'create')
            ->notEmptyString('value');

        $validator
            ->decimal('amount_paid')
            ->allowEmptyString('amount_paid');

        $validator
            ->dateTime('date_paid')
            ->allowEmptyDate('date_paid');

        $validator
            ->integer('status')
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
        $rules->add($rules->existsIn('patient_id', 'Patients'), ['errorField' => 'patient_id']);
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
        if (!empty($data['value'])) {
            $data['value'] = ConvertCharacters::stringToFloat($data['value']);
        }
        if (!empty($data['date'])) {
            $data['date'] = ConvertDates::convertDateTimeToDB("{$data['date']} {$data['time']}");
        }
        if (!empty($data['amount_paid'])) {
            $data['amount_paid'] = ConvertCharacters::stringToFloat($data['amount_paid']);
        }
        if (!empty($data['date_paid'])) {
            $data['date_paid'] = ConvertDates::convertDateToDB($data['date_paid']);
        }
        if (empty($data['description'])) {
            $data['description'] = '';
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
                        "Patients",
                        "Specialists",
                    ]
                ]);
        }
        return $this->newEmptyEntity();
    }
}
