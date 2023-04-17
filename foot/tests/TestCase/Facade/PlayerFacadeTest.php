<?php
declare(strict_types=1);

namespace App\Test\TestCase\Facade;

use App\Facade\PlayerFacade;
use Cake\TestSuite\TestCase;
use App\Model\Table\PlayersTable;

/**
 * PlayerFacadeTest
 * 
 * @package App\Test\TestCase\Facade
 * @property PlayerFacade $facade
 */
class PlayerFacadeTest extends TestCase
{
    private PlayerFacade $facade;

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
        $this->facade = new PlayerFacade();
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
     * 選手登録一覧取得テスト
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
     * 選手登録一覧取得テスト-204
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
     * 選手登録取得テスト-200
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
     * 選手登録取得処理テスト-400
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
     * 選手登録取得処理テスト-204
     * 
     * @return void
     */
    public function testExecuteViewNoContent(): void
    {
        $result = $this->facade->executeView(['id' => 999]);

        $this->assertIsArray($result);
        $this->assertEquals('204', $result['response']['code']);
    }
}