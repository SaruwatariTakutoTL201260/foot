<?php
declare(strict_types=1);

namespace App\Test\TestCass\Model\Logic;

use App\Library\AssertionLibrary;
use App\Model\Logic\MatchSheduleLogic;
use App\Model\Table\MatchShedulesTable;
use Cake\TestSuite\TestCase;

use function PHPUnit\Framework\assertIsArray;

/**
 * MatchSheduleLogicTest
 *
 * @package App\Test\TestCase\Model\Logic
 */
class MatchSheduleLogicTest extends TestCase
{
    private MatchSheduleLogic $logic;

    /**
     * Test subject
     *
     * @var \App\Model\Table\MatchShedulesTable
     */
    protected $matchShedules;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.MatchShedules',
        'app.Teams',
        'app.Leagues',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $config = $this->getTableLocator()->exists('MatchShedules') ? [] : ['className' => MatchShedulesTable::class];
        $this->matchShedules = $this->getTableLocator()->get('MatchShedules', $config);
        $this->logic = new MatchSheduleLogic();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->matchShedules);

        parent::tearDown();
    }

    /**
     * 検索クエリ生成処理テスト-byId
     * @return void
     */
    public function testGenerateQueryById(): void
    {
        $query = $this->logic->generateQuery([
            'id' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.id = 1',
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-bymatchStatus
     * 
     * @return void
     */
    public function testGenerateCoundiotnByMatchStatus(): void
    {
        $query = $this->logic->generateQuery([
            'match_status' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'MatchShedules.match_status = 1',
            $queryString,
            true
        );
    }   

    /**
     * 条件クエリ生成処理テスト-byBeforeMatchDate
     * 
     * @return void
     */
    public function testGenerateCoundiotnByBeforeMatchDate(): void
    {
        $query = $this->logic->generateQuery([
            'before_match_date' => '2023-02-14 20:07:23',
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            "MatchShedules.match_date <= '2023-02-14 20:07:23'",
            $queryString,
        );
    }

    /**
     * 条件クエリ生成処理テスト-byAfterMatchDate
     * 
     * @return void
     */
    public function testGenerateCoundiotnbyAfterMatchDate(): void
    {
        $query = $this->logic->generateQuery([
            'after_match_date' => '2023-02-14 20:07:23',
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            "MatchShedules.match_date >= '2023-02-14 20:07:23'",
            $queryString,
        );
    }

    /**
     * 条件クエリ生成処理テスト-byHomeScore
     * 
     * @return void
     */
    public function testGenerateCoundiotnByHomeScore(): void
    {
        $query = $this->logic->generateQuery([
            'home_score' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "MatchShedules.home_score = 1",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byAwayScore
     * 
     * @return void
     */
    public function testGenerateCoundiotnByAwayScore(): void
    {
        $query = $this->logic->generateQuery([
            'away_score' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "MatchShedules.away_score = 1",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byHomeTeamId
     * 
     * @return void
     */
    public function testGenerateCoundiotnByHomeTeamId(): void
    {
        $query = $this->logic->generateQuery([
            'home_team_id' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "MatchShedules.home_team_id = 1",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byAwayTeamId
     * 
     * @return void
     */
    public function testGenerateCoundiotnByAwayTeamId(): void
    {
        $query = $this->logic->generateQuery([
            'away_team_id' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "MatchShedules.away_team_id = 1",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byLeagueId
     * 
     * @return void
     */
    public function testGenerateCoundiotnByLeagueId(): void
    {
        $query = $this->logic->generateQuery([
            'league_id' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "MatchShedules.league_id = 1",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byGetId
     * 
     * @return void
     */
    public function testGenerateCoundiotnByGetId(): void
    {
        $query = $this->logic->generateQuery([
            'get_id' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "MatchShedules.get_id = 1",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byRefereeId
     * 
     * @return void
     */
    public function testGenerateCoundiotnByRefereeId(): void
    {
        $query = $this->logic->generateQuery([
            'referee_id' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "MatchShedules.referee_id = 1",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byStudiumId
     * 
     * @return void
     */
    public function testGenerateCoundiotnByStudiumId(): void
    {
        $query = $this->logic->generateQuery([
            'studium_id' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "MatchShedules.studium_id = 1",
            $queryString,
            true
        );
    }

    /**
     * 試合日程一覧取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataListSuccessOrderByGoal(): void
    {
        $result = $this->logic->fetchDataList([
            'id' => 1,
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 試合日程一覧取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataListSuccessById(): void
    {
        $result = $this->logic->fetchDataList([
            'before_match_date' => '2035-01-01 00:00:00',
            'after_match_date' => '2030-08-21 12:35:12',
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 試合日程一覧取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataListSuccessEmpty(): void
    {
        $result = $this->logic->fetchDataList([]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 試合日程一覧取得処理テスト-204
     * 
     * @return void
     */
    public function testFetchDataListNoContent(): void
    {
        $result = $this->logic->fetchDataList([
            'id' => 999,
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('204', $result['code']);
    }

    /**
     * 試合日程取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataSuccess(): void
    {
        $result = $this->logic->fetchData([
            'id' => '3',
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 試合日程取得処理テスト-400
     * 
     * @return void
     */
    public function testFetchDataBadRequest(): void
    {
        $result = $this->logic->fetchData([]);

        $this->assertIsArray($result);
        $this->assertEquals('400', $result['code']);
    }

    /**
     * 試合日程取得処理テスト-204
     * 
     * @return void
     */
    public function testFetchDataNoContent(): void
    {
        $result = $this->logic->fetchData([
            'id' => 999
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('204', $result['code']);
    }

    /**
     * 試合日程一括登録処理-200
     * 
     * @return void
     */
    public function testInsertAllSuccess(): void
    {
        $result = $this->logic->insertAll([
            [
                'league_id' => 1,
                'home_team_id' => 1,
                'away_team_id' => 1,
                'match_date' => '2023-05-04 20:07:29',
                'home_score' => 3,
                'away_score' => 1,
                'match_status' => 2,
                'referee_id' => 1,
                'studium_id' => 1,
                'get_id' => 1,
            ],
            [
                'league_id' => 2,
                'home_team_id' => 2,
                'away_team_id' => 2,
                'match_date' => '2023-05-14 20:07:29',
                'home_score' => 4,
                'away_score' => 1,
                'match_status' => 1,
                'is_deleted' => 0,
                'referee_id' => 2,
                'studium_id' => 2,
                'get_id' => 2,
            ],
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 試合日程一括登録処理-500
     * 
     * @return void
     */
    public function testInsertAllValidationError(): void
    {
        $result = $this->logic->insertAll([
            [
                'league_id' => 999,
                'home_team_id' => 1,
                'away_team_id' => 1,
                'match_date' => '2023-05-04 20:07:29',
                'home_score' => 3,
                'away_score' => 1,
                'match_status' => 2,
                'referee_id' => 1,
                'studium_id' => 1,
                'get_id' => 1,
            ],
            [
                'league_id' => 2,
                'home_team_id' => 2,
                'away_team_id' => 2,
                'match_date' => '2023-05-14 20:07:29',
                'home_score' => 4,
                'away_score' => 1,
                'match_status' => 1,
                'is_deleted' => 0,
                'referee_id' => 2,
                'studium_id' => 2,
                'get_id' => 2,
            ],
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('500', $result['code']);
    }

    /**
     * 登録パラメータ整形処理
     * 
     * @return void
     */
    public function testMappingParams(): void
    {
        $params = [
            'fixture' => [
                'id' => (int) 868321,
                'referee' => null,
                'date' => '2023-05-29T00:30:00+09:00',
                'timestamp' => (int) 1685287800,
                'venue' => [
                    'id' => (int) 8560,
                ],
                'status' => [
                    'short' => 'NS',
                ]
            ],
            'goals' => [
                'home' => null,
                'away' => null
            ],      
        ];

        // 処理実行
        $result = $this->logic->mappingParams($params, 1, 1, 1);

        assertIsArray($result);
    }
} 

