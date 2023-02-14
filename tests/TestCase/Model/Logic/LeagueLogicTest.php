<?php
declare(strict_types=1);

namespace App\Test\TestCass\Model\Logic;

use App\Library\AssertionLibrary;
use App\Model\Logic\LeagueLogic;
use App\Model\Table\LeaguesTable;
use Cake\TestSuite\TestCase;

/**
 * LeagueLogicTest
 *
 * @package App\Test\TestCase\Model\Logic
 */
class LeagueLogicTest extends TestCase
{
    private LeagueLogic $logic;

    /**
     * Test subject
     *
     * @var \App\Model\Table\LeaguesTable
     */
    protected $Leagues;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Leagues',
        'app.Countries',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $config = $this->getTableLocator()->exists('Leagues') ? [] : ['className' => LeaguesTable::class];
        $this->Leagues = $this->getTableLocator()->get('Leagues', $config);
        $this->logic = new LeagueLogic();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Leagues);

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
            'Leagues.id => 1',
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
            "Leagues.name => 'testName'",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byCountryId
     * 
     * @return void
     */
    public function testGenerateCoundiotnByCountryId(): void
    {
        $query = $this->logic->generateQuery([
            'country_id' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Leagues.country_id => 1",
            $queryString,
            true
        );
    }

    /**
     * リーグ一覧取得処理テスト-200
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
     * リーグ一覧取得処理テスト-204
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
     * リーグ取得処理テスト-200
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
     * リーグ取得処理テスト-400
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
     * リーグ取得処理テスト-400
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

