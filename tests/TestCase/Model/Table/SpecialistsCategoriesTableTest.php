<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpecialistsCategoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpecialistsCategoriesTable Test Case
 */
class SpecialistsCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SpecialistsCategoriesTable
     */
    protected $SpecialistsCategories;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.SpecialistsCategories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SpecialistsCategories') ? [] : ['className' => SpecialistsCategoriesTable::class];
        $this->SpecialistsCategories = $this->getTableLocator()->get('SpecialistsCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SpecialistsCategories);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SpecialistsCategoriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
