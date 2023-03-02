<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Specialist Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $cpf
 * @property string|null $phone
 * @property string|null $cell_phone
 * @property int $user_id
 * @property int $specialist_category_id
 * @property int $status
 * @property string|null $content
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Patient[] $patients
 */
class Specialist extends Entity
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
        'user_id' => true,
        'specialist_category_id' => true,
        'status' => true,
        'content' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'patients' => true,
    ];
}
