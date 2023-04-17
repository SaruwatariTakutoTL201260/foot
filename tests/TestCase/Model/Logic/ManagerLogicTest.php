<?php
declare(strict_types=1);

namespace App\Test\TestCass\Model\Logic;

use App\Library\AssertionLibrary;
use App\Model\Logic\ManagerLogic;
use App\Model\Table\ManagersTable;
use Cake\TestSuite\TestCase;

/**
 * ManagerLogicTest
 *
 * @package App\Test\TestCase\Model\Logic
 */
class ManagerLogicTest extends TestCase
{
    private ManagerLogic $logic;

    /**
     * Test subject
     *
     * @var \App\Model\Table\ManagersTable
     */
    protected $managers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Managers',
        'app.Teams',
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

        $config = $this->getTableLocator()->exists('Managers') ? [] : ['className' => ManagersTable::class];
        $this->managers = $this->getTableLocator()->get('Managers', $config);
        $this->logic = new ManagerLogic();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->managers);

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
            'Managers.id = 1',
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
            "Managers.name = 'testName'",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byEnglishName
     * 
     * @return void
     */
    public function testGenerateCoundiotnByEnglishName(): void
    {
        $query = $this->logic->generateQuery([
            'english_name' => 'testEnglishName',
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Managers.english_name = 'testEnglishName'",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byAge
     * 
     * @return void
     */
    public function testGenerateCoundiotnByAge(): void
    {
        $query = $this->logic->generateQuery([
            'age' => 3,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Managers.age = 3",
            $queryString,
            true
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
            "Managers.team_id = 1",
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
            "Managers.country_id = 1",
            $queryString,
            true
        );
    }

    /**
     * 条件クエリ生成処理テスト-byGetCouchId
     * 
     * @return void
     */
    public function testGenerateCoundiotnByGetCouchId(): void
    {
        $query = $this->logic->generateQuery([
            'get_couch_id' => 1,
        ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Managers.get_couch_id = 1",
            $queryString,
            true
        );
    }

    /**
     * 監督一覧取得処理テスト-200(name)
     * 
     * @return void
     */
    public function testFetchDataListSuccessByName(): void
    {
        $result = $this->logic->fetchDataList([
            'name' => 'testName',
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 監督一覧取得処理テスト-200
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
     * 監督一覧取得処理テスト-204
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
     * 監督取得処理テスト-200
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
     * 監督取得処理テスト-400
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
     * 監督取得処理テスト-204
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

