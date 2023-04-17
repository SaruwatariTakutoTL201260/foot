<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlayersTable;
use Cake\TestSuite\TestCase;
use App\Library\AssertionLibrary;

/**
 * App\Model\Table\PlayersTable Test Case
 */
class PlayersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlayersTable
     */
    protected $Players;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Players',
        'app.Teams',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Players') ? [] : ['className' => PlayersTable::class];
        $this->Players = $this->getTableLocator()->get('Players', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Players);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PlayersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PlayersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * 有効データ指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindActive(): void
    {
        $query = $this->Players->find()
            ->find('active');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'Players.is_deleted = 0',
            $queryString,
            true,
        );
    }

    /**
     * ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindById(): void
    {
        $query = $this->Players->find()
            ->find('byId', [
                'id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'Players.id = 1',
            $queryString,
            true,
        );
    }

    /**
     * ポジション指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByPositionStatus(): void
    {
        $query = $this->Players->find()
            ->find('byPositionStatus', [
                'position_status' => '0',
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            'Players.position_status = 0',
            $queryString,
        );
    }

    /**
     * 選手登録名ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByName(): void
    {
        $query = $this->Players->find()
            ->find('byName', [
                'name' => 'testName',
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Players.name = 'testName'",
            $queryString,
            true,
        );
    }

    /**
     * チームID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByTeamId(): void
    {
        $query = $this->Players->find()
            ->find('byTeamId', [
                'team_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Players.team_id = 1",
            $queryString,
            true,
        );
    }

    /**
     * Teamsのcontainテスト(#615)
     *
     * @return void
     */
    public function testFindContainTeams(): void
    {
        $query = $this->Players->find()
            ->find('containTeams');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            'INNER JOIN teams Teams ON (Teams.is_deleted = 0 AND Teams.id = Players.team_id)',
            $queryString,
        );
    }
}
