<?php
declare(strict_types=1);

namespace App\Test\TestCase\Facade;

use App\Facade\LeagueFacade;
use Cake\TestSuite\TestCase;
use App\Model\Table\LeaguesTable;

/**
 * LeagueFacadeTest
 * 
 * @package App\Test\TestCase\Facade
 * @property LeagueFacade $facade
 */
class LeagueFacadeTest extends TestCase
{
    private LeagueFacade $facade;

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
        'app.Countries',
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

        $config = $this->getTableLocator()->exists('Leagues') ? [] : ['className' => LeaguesTable::class];
        $this->Leagues = $this->getTableLocator()->get('Leagues', $config);
        $this->facade = new LeagueFacade();
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
     * リーグ一覧取得テスト
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
     * リーグ一覧取得テスト-204
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
     * リーグ取得テスト-200
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
     * リーグ取得処理テスト-400
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
     * リーグ取得処理テスト-204
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