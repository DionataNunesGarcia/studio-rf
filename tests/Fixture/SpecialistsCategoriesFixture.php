<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SpecialistsCategoriesFixture
 */
class SpecialistsCategoriesFixture extends TestFixture
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
                'slug' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2023-02-21 18:48:32',
                'modified' => '2023-02-21 18:48:32',
            ],
        ];
        parent::init();
    }
}
