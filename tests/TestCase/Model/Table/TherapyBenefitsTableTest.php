<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TherapyBenefitsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TherapyBenefitsTable Test Case
 */
class TherapyBenefitsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TherapyBenefitsTable
     */
    protected $TherapyBenefits;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.TherapyBenefits',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TherapyBenefits') ? [] : ['className' => TherapyBenefitsTable::class];
        $this->TherapyBenefits = $this->getTableLocator()->get('TherapyBenefits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TherapyBenefits);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TherapyBenefitsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
