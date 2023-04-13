<?php
declare(strict_types=1);

namespace App\Test\TestCase\Facade;

use App\Facade\PlayerRecordFacade;
use App\Model\Table\PlayerRecordsTable;
use Cake\TestSuite\TestCase;

/**
 * PlayerRecordFacadeTest
 * 
 * @package App\Test\TestCase\Facade
 * @property PlayerRecordFacade $facade
 */
class PlayerRecordFacadeTest extends TestCase
{
    private PlayerRecordFacade $facade;

    /**
     * Test subject
     *
     * @var \App\Model\Table\PlayerRecordsTable
     */
    protected $PlayerRecords;

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
        $this->PlayerRecords = $this->getTableLocator()->get('PlayerRecords', $config);
        $this->facade = new PlayerRecordFacade();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PlayerRecords);

        parent::tearDown();
    }

    /**
     * 選手成績一覧取得テスト
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
     * 選手成績一覧取得テスト-204
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
     * 選手成績取得テスト-200
     * 
     * @return void
     */
    public function testExecuteViewSuccess(): void
    {
        $result = $this->facade->executeView(['assist' => 3]);

        $this->assertIsArray($result);
        $this->assertEquals(3, $result['response']['data']['assist']);
    }

    /**
     * 選手成績取得処理テスト-400
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
     * 選手成績取得処理テスト-204
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