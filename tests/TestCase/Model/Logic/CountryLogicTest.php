<?php
declare(strict_types=1);

namespace App\Test\TestCass\Model\Logic;

use App\Library\AssertionLibrary;
use App\Model\Logic\CountryLogic;
use App\Model\Table\CountriesTable;
use Cake\TestSuite\TestCase;

/**
 * CountryLogicTest
 *
 * @package App\Test\TestCase\Model\Logic
 */
class CountryLogicTest extends TestCase
{
    private CountryLogic $logic;

    /**
     * Test subject
     *
     * @var \App\Model\Table\CountriesTable
     */
    protected $Countries;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
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

        $config = $this->getTableLocator()->exists('Countries') ? [] : ['className' => CountriesTable::class];
        $this->Countries = $this->getTableLocator()->get('Countries', $config);
        $this->logic = new CountryLogic();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Countries);

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
            'Countries.id => 1',
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
            "Countries.name => 'testName'",
            $queryString,
            true
        );
    }

    /**
     * 国一覧取得処理テスト-200
     * 
     * @return void
     */
    public function testFetchDataListById(): void
    {
        $result = $this->logic->fetchDataList([
            'id' => 1,
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 国一覧取得処理テスト-204
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
     * 国取得処理テスト-200
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
     * 国取得処理テスト-400
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
     * 国取得処理テスト-400
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
     * 国編集処理テスト-400(条件未指定)
     * 
     * @return void
     */
    public function testUpdateBadRequest(): void
    {
        $result = $this->logic->update([], []);

        $this->assertIsArray($result);
        $this->assertEquals('400', $result['code']);
    }

    /**
     * 国編集処理テスト-400(条件不一致)
     * 
     * @return void
     */
    public function testUpdateNoMatchCondition(): void
    {
        $result = $this->logic->update(['id' => 999], []);

        $this->assertIsArray($result);
        $this->assertEquals('400', $result['code']);
    }

    /**
     * 国編集処理テスト-400(条件不一致)
     * 
     * @return void
     */
    public function testUpdateSuccess(): void
    {
        $result = $this->logic->update(['id' => 1], ['name' => 'changedName']);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 国編集処理テスト-500(条件不一致)
     * 
     * 
     * @return void
     */
    public function testUpdateServerError(): void
    {
        $result = $this->logic->update(['id' => 1], ['name' => str_repeat('a', 256)]);

        $this->assertIsArray($result);
        $this->assertEquals('500', $result['code']);
    }

    /**
     * 国登録処理-200
     * 
     * @return void
     */
    public function testInsertSuccess(): void
    {
        $result = $this->logic->insert([
            'name' => 'testName',
        ]);
        
        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 国登録処理-200
     * 
     * @return void
     */
    public function testInsertServerError(): void
    {
        $result = $this->logic->insert([
            'name' => str_repeat('a', 256),
        ]);
        
        $this->assertIsArray($result);
        $this->assertEquals('500', $result['code']);
    }

    /**
     * 国論理削除処理テスト-200
     * 
     * @return void
     */
    public function testDeleteSuccess(): void
    {
        $result = $this->logic->delete([
            'id' => 2,
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['code']);
    }

    /**
     * 国論理削除処理テスト-204
     * 
     * @return void
     */
    public function testDeleteNoContent(): void
    {
        $result = $this->logic->delete([
            'id' => 999,
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('204', $result['code']);
    }

    /**
     * 国論理削除処理テスト-400
     * 
     * @return void
     */
    public function testDeleteBadRequest(): void
    {
        $result = $this->logic->delete([]);

        $this->assertIsArray($result);
        $this->assertEquals('400', $result['code']);
    }
} 

