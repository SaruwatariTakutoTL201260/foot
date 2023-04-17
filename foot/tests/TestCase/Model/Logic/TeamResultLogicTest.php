<?php
declare(strict_types=1);

namespace App\Test\TestCass\Model\Logic;

use App\Library\AssertionLibrary;
use App\Model\Logic\TeamResultLogic;
use App\Model\Table\TeamResultsTable;
use Cake\TestSuite\TestCase;

/**
 * TeamResultLogicTest
 *
 * @package App\Test\TestCase\Model\Logic
 */
class TeamResultLogicTest extends TestCase
{
    private TeamResultLogic $logic;

    /**
     * Test subject
     *
     * @var \App\Model\Table\TeamResultsTable
     */
    protected $TeamResults;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.TeamResults',
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

        $config = $this->getTableLocator()->exists('TeamResults') ? [] : ['className' => TeamResultsTable::class];
        $this->TeamResults = $this->getTableLocator()->get('TeamResults', $config);
        $this->logic = new TeamResultLogic();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TeamResults);

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
            'TeamResults.id = 1',
            $queryString,
            true
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
            "TeamResults.match_date < '2023-02-14 20:07:23'",
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
            "TeamResults.team_id = 1",
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
            'match_date' => '2023-02-14 20:07:24',
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * チーム一覧取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataListSuccessByMatchDate(): void
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
            'match_date' => '2023-02-14 20:07:24',
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
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

