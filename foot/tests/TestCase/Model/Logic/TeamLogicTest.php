<?php
declare(strict_types=1);

namespace App\Test\TestCass\Model\Logic;

use App\Library\AssertionLibrary;
use App\Model\Logic\TeamLogic;
use App\Model\Table\TeamsTable;
use Cake\TestSuite\TestCase;

/**
 * TeamLogicTest
 *
 * @package App\Test\TestCase\Model\Logic
 */
class TeamLogicTest extends TestCase
{
    private TeamLogic $logic;

    /**
     * Test subject
     *
     * @var \App\Model\Table\TeamsTable
     */
    protected $Teams;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Leagues',
        'app.Teams',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $config = $this->getTableLocator()->exists('Teams') ? [] : ['className' => TeamsTable::class];
        $this->Teams = $this->getTableLocator()->get('Teams', $config);
        $this->logic = new TeamLogic();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Teams);

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
            'Teams.id = 1',
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byName
     * 
     * @return void
     */
    public function testGenerateCoundiotnByName(): void
    {
        $query = $this->logic->generateQuery([
            'name' => 'testName',
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Teams.name = 'testName'",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byLeagueId
     * 
     * @return void
     */
    public function testGenerateCoundiotnByCountryId(): void
    {
        $query = $this->logic->generateQuery([
            'league_id' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Teams.league_id = 1",
            $queryString,
            true
        );
    }

    /**
     * チーム一覧取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataListSuccess(): void
    {
        $result = $this->logic->fetchDataList([
            'id' => 1,
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * チーム一覧取得処理テスト-200
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
     * チーム一覧取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataListSuccessByIdList(): void
    {
        $result = $this->logic->fetchDataList([
            'id_list' => [1,2],
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * チーム一覧取得処理テスト-204
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
     * チーム取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataSuccess(): void
    {
        $result = $this->logic->fetchData([
            'name' => 'testName',
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('testName', $result['data']['name']);
    }

    /**
     * チーム取得処理テスト-400
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
     * チーム取得処理テスト-400
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

