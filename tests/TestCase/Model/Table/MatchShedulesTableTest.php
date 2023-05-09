<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MatchShedulesTable;
use Cake\TestSuite\TestCase;
use App\Library\AssertionLibrary;

/**
 * App\Model\Table\MatchShedulesTable Test Case
 */
class MatchShedulesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MatchShedulesTable
     */
    protected $MatchShedules;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.MatchShedules',
        'app.Leagues',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MatchShedules') ? [] : ['className' => MatchShedulesTable::class];
        $this->MatchShedules = $this->getTableLocator()->get('MatchShedules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MatchShedules);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MatchShedulesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MatchShedulesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindById(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byId', [
                'id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.id = 1',
            $queryString,
            true,
        );
    }

    /**
     * 有効データ指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindActive(): void
    {
        $query = $this->MatchShedules->find()
            ->find('active');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.is_deleted = 0',
            $queryString,
            true,
        );
    }

    /**
     * リーグID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByleagueId(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byLeagueId', [
                'league_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.league_id = 1',
            $queryString,
            true,
        );
    }

    /**
     * ホームチームID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByHomeTeamId(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byHomeTeamId', [
                'home_team_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.home_team_id = 1',
            $queryString,
            true,
        );
    }

    /**
     * アウェイチームID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByAwayTeamId(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byAwayTeamId', [
                'away_team_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.away_team_id = 1',
            $queryString,
            true,
        );
    }

    /**
     * 試合ステータス指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByMatchStatus(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byMatchStatus', [
                'match_status' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.match_status = 1',
            $queryString,
            true,
        );
    }

    /**
     * 試合日時以前指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByBeforeMatchDate(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byBeforeMatchDate', [
                'match_date' => '2023-04-18 16:50:50',
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            "MatchShedules.match_date <= '2023-04-18 16:50:50'",
            $queryString,
        );
    }

    /**
     * 試合日時以降指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByAfterMatchDate(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byAfterMatchDate', [
                'match_date' => '2023-02-16 17:53:54',
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            "MatchShedules.match_date >= '2023-02-16 17:53:54'",
            $queryString,
        );
    }

    /**
     * ホーム得点指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByHomeScore(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byHomeScore', [
                'home_score' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.home_score = 1',
            $queryString,
            true,
        );
    }

    /**
     * アウェイ得点指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByAwayScore(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byAwayScore', [
                'away_score' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.away_score = 1',
            $queryString,
            true,
        );
    }

    /**
     * 取得ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByGetId(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byGetID', [
                'get_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.get_id = 1',
            $queryString,
            true,
        );
    }

    /**
     * 審判ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByRefereeId(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byRefereeId', [
                'referee_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.referee_id = 1',
            $queryString,
            true,
        );
    }

    /**
     * スタジアムID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByStudiumId(): void
    {
        $query = $this->MatchShedules->find()
            ->find('byStudiumId', [
                'studium_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.studium_id = 1',
            $queryString,
            true,
        );
    }

    /**
     * containテスト
     * 
     * LeaguesとTeams(home,away)とのcontainを想定
     * 
     * @return void
     */
    public function testFindCntain(): void
    {
        $query = $this->MatchShedules->find()
            ->find('containTeams')
            ->find('containAwayTeams')
            ->find('containLeagues');

        $queryString = AssertionLibrary::getBindingQuery($query);

        // ホームチームとのコンテイン
        $this->assertTextContains(
            'INNER JOIN teams Teams ON (Teams.is_deleted = 0 AND Teams.id = MatchShedules.home_team_id)',
            $queryString,
        );

        // アウェイチームとのコンテイン
        $this->assertTextContains(
            "INNER JOIN teams AwayTeams ON (AwayTeams.is_deleted = 0 AND AwayTeams.id = MatchShedules.away_team_id)",
            $queryString,
        );

        // リーグとのコンテイン
        $this->assertTextContains(
            'INNER JOIN leagues Leagues ON (Leagues.is_deleted = 0 AND Leagues.id = MatchShedules.league_id)',
            $queryString,
        );

    }
}
