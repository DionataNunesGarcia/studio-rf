<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SlidesHomeFixture
 */
class SlidesHomeFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'slides_home';
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
                'title' => 'Lorem ipsum dolor sit amet',
                'subtitle' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-05-04 23:16:10',
                'modified' => '2023-05-04 23:16:10',
            ],
        ];
        parent::init();
    }
}
