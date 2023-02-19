<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OurServicesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OurServicesTable Test Case
 */
class OurServicesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OurServicesTable
     */
    protected $OurServices;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.OurServices',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OurServices') ? [] : ['className' => OurServicesTable::class];
        $this->OurServices = $this->getTableLocator()->get('OurServices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OurServices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OurServicesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
