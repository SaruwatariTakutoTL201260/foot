<?php
declare(strict_types=1);

namespace App\Test\TestCase\Facade;

use App\Facade\TeamFacade;
use App\Facade\TeamResultFacade;
use Cake\TestSuite\TestCase;
use App\Model\Table\TeamsTable;
use App\Model\Table\TeamResultsTable;

use function PHPUnit\Framework\assertIsArray;

/**
 * TeamFacadeTest
 * 
 * @package App\Test\TestCase\Facade
 * @property TeamResultFacade $facade
 */
class TeamResultFacadeTest extends TestCase
{
    private TeamResultFacade $facade;

    /**
     * Test subject
     *
     * @var \App\Model\Table\TeamsTable
     * @var \App\Model\Table\TeamResultsTable
     */
    protected $Teams;
    protected $TeamResults;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Teams',
        'app.TeamResults',
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

        $config = $this->getTableLocator()->exists('TeamResults') ? [] : ['className' => TeamResultsTable::class];
        $this->TeamResults = $this->getTableLocator()->get('TeamResults', $config);
        $this->facade = new TeamResultFacade();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Teams);

        parent::tearDown();
    }

    /**
     * チーム一覧取得テスト
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
     * チーム一覧取得テスト-204
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
     * チーム取得処理テスト-400
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
     * チーム取得処理テスト-204
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
     * リーグ順位取得Facade
     * 
     * @return void
     */
    public function testExecuteScore(): void
    {
        $result = $this->facade->executeScore([
            'league_id' => 1,
            'match_date' => '2023-02-12 20:07:23',
        ]);

        assertIsArray($result);
    }

    /**
     * リーグ順位取得Facade
     * 
     * @return void
     */
    public function testExecuteScoreError(): void
    {
        $result = $this->facade->executeScore([
            'league_id' => 2,
            'match_date' => '2023-02-12 20:07:23',
        ]);

        $this->assertIsArray($result);
        $this->assertEquals('204', $result['response']['code']);
    }
}