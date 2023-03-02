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
 * Specialists Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PatientsTable&\Cake\ORM\Association\HasMany $Patients
 *
 * @method \App\Model\Entity\Specialist newEmptyEntity()
 * @method \App\Model\Entity\Specialist newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Specialist[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Specialist get($primaryKey, $options = [])
 * @method \App\Model\Entity\Specialist findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Specialist patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Specialist[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Specialist|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Specialist saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Specialist[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Specialist[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Specialist[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Specialist[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SpecialistsTable extends Table
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

        $this->setTable('specialists');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('SpecialistsCategories', [
            'foreignKey' => 'specialist_category_id',
            'joinType' => 'INNER',
        ]);
        $this->hasOne('Avatar', [
            'className' => 'Uploads',
            'foreignKey' => [
                'foreign_key'
            ],
            'joinType' => 'LEFT',
            'conditions' => [
                'Avatar.model' => 'Specialists',
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
        if (isset($data['content'])) {
            $data['content'] = trim(utf8_encode($data['content']));
        }
        if (!empty($data['phone'])) {
            $data['phone'] = ConvertCharacters::onlyNumbers($data['phone']);
        }
        if (!empty($data['cell_phone'])) {
            $data['cell_phone'] = ConvertCharacters::onlyNumbers($data['cell_phone']);
        }
        if (!empty($data['cpf'])) {
            $data['cpf'] = ConvertCharacters::onlyNumbers($data['cpf']);
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
                        "Users.Avatar",
                        "SpecialistsCategories",
                    ]
                ]);
        }
        $entity = $this->newEmptyEntity();
        $entity->user = $this->Users->newEmptyEntity();
        return $entity;
    }
}
