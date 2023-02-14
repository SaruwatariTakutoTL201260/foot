<?php
declare(strict_types=1);

namespace App\Test\TestCase\Facade;

use App\Facade\CountryFacade;
use Cake\TestSuite\TestCase;
use App\Model\Table\CountriesTable;

/**
 * CountryFacadeTest
 * 
 * @package App\Test\TestCase\Facade
 * @property CountryFacade $facade
 */
class CountryFacadeTest extends TestCase
{
    private CountryFacade $facade;

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
        $this->facade = new CountryFacade();
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
     * 国一覧取得テスト
     * 
     * @return void
     */
    public function testExecuteIndexSuccess(): void
    {
        $result = $this->facade->executeIndex([]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['response']['code']);
    }

    /**
     * 国一覧取得テスト-204
     * 
     * @return void
     */
    public function testExecuteIndexNoContent(): void
    {
        $result = $this->facade->executeIndex(['id' => 999]);

        $this->assertIsArray($result);
        $this->assertEquals('204',$result['response']['code']);
    }

    /**
     * 国取得テスト-200
     * 
     * @return void
     */
    public function testExecuteViewSuccess(): void
    {
        $result = $this->facade->executeView(['name' => 'testName']);

        $this->assertIsArray($result);
        $this->assertEquals('testName', $result['response']['data']['name']);
    }

    /**
     * 国取得処理テスト-400
     * 
     * @return void
     */
    public function testExecuteViewBadRequest(): void
    {
        $result = $this->facade->executeView([]);

        $this->assertIsArray($result);
        $this->assertEquals('400', $result['response']['code']);
    }

    /**
     * 国取得処理テスト-204
     * 
     * @return void
     */
    public function testExecuteViewNoContent(): void
    {
        $result = $this->facade->executeView(['id' => 999]);

        $this->assertIsArray($result);
        $this->assertEquals('204', $result['response']['code']);
    }

    /**
     * 国登録処理テスト-200
     * 
     * @return void
     */
    public function testExecuteAddSuccess(): void
    {
        $result = $this->facade->executeAdd([
            'name' => 'testName',
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['response']['code']);
        $this->assertEquals('登録が完了しました', $result['response']['data']);
    }

    /**
     * 国登録処理テスト-500
     * 
     * @return void
     */
    public function testExecuteAddServerError(): void
    {
        $result = $this->facade->executeAdd([]);

        $this->assertIsArray($result);
        $this->assertEquals('500', $result['response']['code']);
    }

    /**
     * 国編集処理テスト-200
     * 
     * @return void
     */
    public function testExecuteEditSuceess(): void
    {
        $result = $this->facade->executeEdit(['id' => 1],['name' => 'testName']);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['response']['code']);
        $this->assertEquals('更新しました', $result['response']['data']);
    }

    /**
     * 国編集処理テスト-400(条件未設定)
     * 
     * @return void
     */
    public function testExecuteEditBadRequest(): void
    {
        $result = $this->facade->executeEdit([],['name' => 'testName']);

        $this->assertIsArray($result);
        $this->assertEquals('400', $result['response']['code']);
    }

    /**
     * 国編集処理テスト-400(条件一致なし)
     * 
     * @return void
     */
    public function testExecuteEditNoSubject(): void
    {
        $result = $this->facade->executeEdit(['id' => 999],['name' => 'testName']);

        $this->assertIsArray($result);
        $this->assertEquals('400', $result['response']['code']);
    }

    /**
     * 国編集処理テスト-500
     * 
     * @return void
     */
    public function testExecuteEditServerError(): void
    {
        $result = $this->facade->executeEdit(['id' => 1],['name' => '']);

        $this->assertIsArray($result);
        $this->assertEquals('500', $result['response']['code']);
    }

    /**
     * 国論理削除処理-200
     * 
     * @return void
     */
    public function testExecuteDeleteSuccess(): void
    {
        $result = $this->facade->executeDelete(['id' => '2']);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['response']['code']);
    }

    /**
     * 国論理削除処理-400
     * 
     * @return void
     */
    public function testExecuteDeleteBadRequest(): void
    {
        $result = $this->facade->executeDelete([]);

        $this->assertIsArray($result);
        $this->assertEquals('400', $result['response']['code']);
    }

    /**
     * 国論理削除処理-204
     * 
     * @return void
     */
    public function testExecuteDeleteNoContent(): void
    {
        $result = $this->facade->executeDelete(['id' => 999]);

        $this->assertIsArray($result);
        $this->assertEquals('204', $result['response']['code']);
    }
}