<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TagsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TagsTable Test Case
 */
class TagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TagsTable
     */
    protected $Tags;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Tags',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Tags') ? [] : ['className' => TagsTable::class];
        $this->Tags = $this->getTableLocator()->get('Tags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Tags);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TagsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test beforeMarshal method
     *
     * @return void
     * @uses \App\Model\Table\TagsTable::beforeMarshal()
     */
    public function testBeforeMarshal(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getEntity method
     *
     * @return void
     * @uses \App\Model\Table\TagsTable::getEntity()
     */
    public function testGetEntity(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
