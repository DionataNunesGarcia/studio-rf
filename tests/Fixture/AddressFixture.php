<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AddressFixture
 */
class AddressFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'address';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'cep' => 'Lorem ipsum d',
                'street' => 'Lorem ipsum dolor sit amet',
                'number' => 'Lorem ipsum dolor sit amet',
                'district' => 'Lorem ipsum dolor sit amet',
                'complement' => 'Lorem ipsum dolor sit amet',
                'lat' => 'Lorem ipsum dolor sit amet',
                'long' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'uf' => 'Lo',
                'foreign_key' => 1,
                'model' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-08-15 20:42:48',
                'modified' => '2022-08-15 20:42:48',
            ],
        ];
        parent::init();
    }
}
