<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlayerRecordsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlayerRecordsTable Test Case
 */
class PlayerRecordsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlayerRecordsTable
     */
    protected $PlayerRecords;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PlayerRecords',
        'app.Leagues',
        'app.Teams',
        'app.Players',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PlayerRecords') ? [] : ['className' => PlayerRecordsTable::class];
        $this->PlayerRecords = $this->getTableLocator()->get('PlayerRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PlayerRecords);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PlayerRecordsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PlayerRecordsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
