<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Testimonial Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $profession
 * @property string $user_id
 * @property int $status
 * @property int $note
 * @property string|null $content
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Testimonial extends Entity
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
        'slug' => true,
        'profession' => true,
        'user_id' => true,
        'status' => true,
        'note' => true,
        'content' => true,
        'created' => true,
        'modified' => true,
    ];
}