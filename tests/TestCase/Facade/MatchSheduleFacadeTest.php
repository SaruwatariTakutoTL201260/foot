<?php
declare(strict_types=1);

namespace App\Test\TestCase\Facade;

use App\Facade\MatchSheduleFacade;
use App\Facade\PlayerRecordFacade;
use App\Model\Table\MatchShedulesTable;
use App\Model\Table\PlayerRecordsTable;
use Cake\TestSuite\TestCase;

/**
 * MatchSheduleFacadeTest
 * 
 * @package App\Test\TestCase\Facade
 * @property MatchSheduleFacade $facade
 */
class MatchSheduleFacadeTest extends TestCase
{
    private MatchSheduleFacade $facade;

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
        'app.MatchShedules',
        'app.Teams',
        'app.Leagues',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $config = $this->getTableLocator()->exists('MatchShedules') ? [] : ['className' => MatchShedulesTable::class];
        $this->PlayerRecords = $this->getTableLocator()->get('MatchShedules', $config);
        $this->facade = new MatchSheduleFacade();
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
     * 試合日程一覧取得テスト
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
     * 試合日程一覧取得テスト-204
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
     * 試合日程取得テスト-200
     * 
     * @return void
     */
    public function testExecuteViewSuccess(): void
    {
        $result = $this->facade->executeView(['home_score' => 1]);

        $this->assertIsArray($result);
        $this->assertEquals(1, $result['response']['data']['home_score']);
    }

    /**
     * 試合日程取得処理テスト-400
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
     * 試合日程取得処理テスト-204
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