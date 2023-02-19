<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Consultation Entity
 *
 * @property int $id
 * @property int $patient_id
 * @property int $specialist_id
 * @property int $user_id
 * @property string $description
 * @property \Cake\I18n\FrozenTime|null $date
 * @property string $value
 * @property string|null $amount_paid
 * @property \Cake\I18n\FrozenTime|null $date_paid
 * @property int $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Patient $patient
 * @property \App\Model\Entity\Specialist $specialist
 * @property \App\Model\Entity\User $user
 */
class Consultation extends Entity
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
        'patient_id' => true,
        'specialist_id' => true,
        'user_id' => true,
        'description' => true,
        'date' => true,
        'value' => true,
        'amount_paid' => true,
        'date_paid' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'patient' => true,
        'specialist' => true,
        'user' => true,
    ];
}
