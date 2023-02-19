<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Addres Entity
 *
 * @property int $id
 * @property string|null $cep
 * @property string|null $street
 * @property string|null $number
 * @property string|null $district
 * @property string|null $complement
 * @property string|null $lat
 * @property string|null $long
 * @property string|null $city
 * @property string|null $uf
 * @property int $foreign_key
 * @property string $model
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Addres extends Entity
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
        'cep' => true,
        'street' => true,
        'number' => true,
        'district' => true,
        'complement' => true,
        'lat' => true,
        'long' => true,
        'city' => true,
        'uf' => true,
        'foreign_key' => true,
        'model' => true,
        'created' => true,
        'modified' => true,
    ];
}
