<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConsultationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConsultationsTable Test Case
 */
class ConsultationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ConsultationsTable
     */
    protected $Consultations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Consultations',
        'app.Patients',
        'app.Specialists',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Consultations') ? [] : ['className' => ConsultationsTable::class];
        $this->Consultations = $this->getTableLocator()->get('Consultations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Consultations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ConsultationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ConsultationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
