<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $cpf
 * @property string|null $phone
 * @property string|null $cell_phone
 * @property \Cake\I18n\FrozenDate|null $birth_date
 * @property string $query_value
 * @property string|null $observations
 * @property int $user_id
 * @property int $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Client extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'name' => true,
        'email' => true,
        'cpf' => true,
        'phone' => true,
        'cell_phone' => true,
        'birth_date' => true,
        'query_value' => true,
        'observations' => true,
        'user_id' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
