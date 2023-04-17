<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlayerRecordsTable;
use Cake\TestSuite\TestCase;
use App\Library\AssertionLibrary;

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

    /**
     * 有効データ指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindActive(): void
    {
        $query = $this->PlayerRecords->find()
            ->find('active');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'PlayerRecords.is_deleted = 0',
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
        $query = $this->PlayerRecords->find()
            ->find('byId', [
                'id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'PlayerRecords.id = 1',
            $queryString,
            true,
        );
    }

    /**
     * ゴール数指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByGoal(): void
    {
        $query = $this->PlayerRecords->find()
            ->find('byGoal', [
                'goal' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'PlayerRecords.goal = 1',
            $queryString,
            true,
        );
    }

    /**
     * ゴールランキングカスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindOrderByGoal(): void
    {
        $query = $this->PlayerRecords->find()
            ->find('orderByGoal');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'ORDER BY goal DESC',
            $queryString,
            true,
        );
    }

    /**
     * アシスト数指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByAssist(): void
    {
        $query = $this->PlayerRecords->find()
            ->find('byAssist', [
                'assist' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'PlayerRecords.assist = 1',
            $queryString,
            true,
        );
    }

    /**
     * 試合日時指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByMatchDate(): void
    {
        $query = $this->PlayerRecords->find()
            ->find('byMatchDate', [
                'match_date' => '2023-02-16 17:53:54',
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            "PlayerRecords.match_date < '2023-02-16 17:53:54'",
            $queryString,
        );
    }

    /**
     * チームID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByTeamId(): void
    {
        $query = $this->PlayerRecords->find()
            ->find('byTeamId', [
                'team_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "PlayerRecords.team_id = 1",
            $queryString,
            true,
        );
    }

    /**
     * リーグID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByLeagueId(): void
    {
        $query = $this->PlayerRecords->find()
            ->find('byLeagueId', [
                'league_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "PlayerRecords.league_id = 1",
            $queryString,
            true,
        );
    }

    /**
     * 選手登録ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByPlayerId(): void
    {
        $query = $this->PlayerRecords->find()
            ->find('byPlayerId', [
                'player_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "PlayerRecords.player_id = 1",
            $queryString,
            true,
        );
    }

    /**
     * containテスト
     *
     * @return void
     */
    public function testFindContain(): void
    {
        $query = $this->PlayerRecords->find()
            ->find('containTeams')
            ->find('containLeagues')
            ->find('containPlayers');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            'INNER JOIN teams Teams ON (Teams.is_deleted = 0 AND Teams.id = PlayerRecords.team_id)',
            $queryString,
        );

        $this->assertTextContains(
            'INNER JOIN leagues Leagues ON (Leagues.is_deleted = 0 AND Leagues.id = PlayerRecords.league_id)',
            $queryString,
        );

        $this->assertTextContains(
            'INNER JOIN players Players ON (Players.is_deleted = 0 AND Players.id = PlayerRecords.player_id)',
            $queryString,
        );
    }
}
