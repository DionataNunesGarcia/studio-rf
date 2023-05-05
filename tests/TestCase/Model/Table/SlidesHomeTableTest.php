<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SlidesHomeTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SlidesHomeTable Test Case
 */
class SlidesHomeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SlidesHomeTable
     */
    protected $SlidesHome;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.SlidesHome',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SlidesHome') ? [] : ['className' => SlidesHomeTable::class];
        $this->SlidesHome = $this->getTableLocator()->get('SlidesHome', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SlidesHome);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SlidesHomeTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
