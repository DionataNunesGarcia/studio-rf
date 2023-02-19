<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SpecialistsFixture
 */
class SpecialistsFixture extends TestFixture
{
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
                'name' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'cpf' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'cell_phone' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'status' => 1,
                'created' => '2022-08-17 00:18:40',
                'modified' => '2022-08-17 00:18:40',
            ],
        ];
        parent::init();
    }
}
