<?php
declare(strict_types=1);

namespace App\Test\TestCass\Model\Logic;

use App\Library\AssertionLibrary;
use App\Model\Logic\PlayerLogic;
use App\Model\Logic\TeamResultLogic;
use App\Model\Table\PlayersTable;
use App\Model\Table\TeamResultsTable;
use Cake\TestSuite\TestCase;

/**
 * PlayerLogicTest
 *
 * @package App\Test\TestCase\Model\Logic
 */
class PlayerLogicTest extends TestCase
{
    private PlayerLogic $logic;

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
    public function setUp(): void
    {
        parent::setUp();

        $config = $this->getTableLocator()->exists('Players') ? [] : ['className' => PlayersTable::class];
        $this->Players = $this->getTableLocator()->get('Players', $config);
        $this->logic = new PlayerLogic();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Players);

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
            'Players.id = 1',
            $queryString,
            true
        );
    }

    /**
     * 検索クエリ生成処理テスト-byName
     * @return void
     */
    public function testGenerateQueryByName(): void
    {
        $query = $this->logic->generateQuery([
            'name' => 'testName',
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Players.name = 'testName'",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byPositionStatus
     * 
     * @return void
     */
    public function testGenerateCoundiotnByPositionStatus(): void
    {
        $query = $this->logic->generateQuery([
            'position_status' => '1',
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            'Players.position_status = 1',
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
            "Players.team_id = 1",
            $queryString,
            true
        );
    }

    /**
     * 選手登録一覧取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataListSuccess(): void
    {
        $result = $this->logic->fetchDataList([
            'position_status' => 1,
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 選手登録一覧取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataListSuccessByPositionStatus(): void
    {
        $result = $this->logic->fetchDataList([
            'id' => 1,
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 選手登録一覧取得処理テスト-200
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
     * 選手登録一覧取得処理テスト-204
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
     * 選手登録取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataSuccess(): void
    {
        $result = $this->logic->fetchData([
            'team_id' => '1',
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 選手登録取得処理テスト-400
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
     * 選手登録取得処理テスト-400
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

