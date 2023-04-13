<?php
declare(strict_types=1);

namespace App\Test\TestCass\Model\Logic;

use App\Library\AssertionLibrary;
use App\Model\Logic\PlayerRecordLogic;
use App\Model\Table\PlayerRecordsTable;
use Cake\TestSuite\TestCase;

/**
 * PlayerRecordLogicTest
 *
 * @package App\Test\TestCase\Model\Logic
 */
class PlayerRecordLogicTest extends TestCase
{
    private PlayerRecordLogic $logic;

    /**
     * Test subject
     *
     * @var \App\Model\Table\PlayerRecordsTable
     */
    protected $playerRecords;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PlayerRecords',
        'app.Teams',
        'app.Leagues',
        'app.Players',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $config = $this->getTableLocator()->exists('PlayerRecords') ? [] : ['className' => PlayerRecordsTable::class];
        $this->playerRecords = $this->getTableLocator()->get('PlayerRecords', $config);
        $this->logic = new PlayerRecordLogic();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->playerRecords);

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
            'PlayerRecords.id = 1',
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-orderByGoal
     * 
     * @return void
     */
    public function testGenerateCoundiotnOrderByGoal(): void
    {
        $query = $this->logic->generateQuery([
            'sort_goal' => true,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            'ORDER BY match_date DESC, goal DESC',
            $queryString,
        );
    }   

    /**
     * 条件クエリ生成処理テスト-byMatchDate
     * 
     * @return void
     */
    public function testGenerateCoundiotnByMatchDate(): void
    {
        $query = $this->logic->generateQuery([
            'match_date' => '2023-02-14 20:07:23',
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            "PlayerRecords.match_date < '2023-02-14 20:07:23'",
            $queryString,
        );
    }

    /**
     * 条件クエリ生成処理テスト-byTeamId
     * 
     * @return void
     */
    public function testGenerateCoundiotnByTeamId(): void
    {
        $query = $this->logic->generateQuery([
            'team_id' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "PlayerRecords.team_id = 1",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byLeagues
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
            "PlayerRecords.league_id = 1",
            $queryString,
            true
        );
    }

    /**
     * 選手成績一覧取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataListSuccessOrderByGoal(): void
    {
        $result = $this->logic->fetchDataList([
            'sort_goal' => true,
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 選手成績一覧取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataListSuccessById(): void
    {
        $result = $this->logic->fetchDataList([
            'id' => 7,
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 選手成績一覧取得処理テスト-200
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
     * 選手成績一覧取得処理テスト-204
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
     * 選手成績取得処理テスト-200
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
     * 選手成績取得処理テスト-400
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
     * 選手成績取得処理テスト-400
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
} 

