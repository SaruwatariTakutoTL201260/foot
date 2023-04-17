<?php
declare(strict_types=1);

namespace App\Test\TestCase\Facade;

use App\Facade\ManagerFacade;
use App\Model\Table\ManagersTable;
use Cake\TestSuite\TestCase;

/**
 * ManagerFacadeTest
 * 
 * @package App\Test\TestCase\Facade
 * @property ManagerFacade $facade
 */
class ManagerFacadeTest extends TestCase
{
    private ManagerFacade $facade;

    /**
     * Test subject
     *
     * @var \App\Model\Table\ManagersTable
     */
    protected $Managers;

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
        $this->Managers = $this->getTableLocator()->get('Managers', $config);
        $this->facade = new ManagerFacade();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Managers);

        parent::tearDown();
    }

    /**
     * 監督一覧取得テスト
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
     * 監督一覧取得テスト-204
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
     * 監督取得テスト-200
     * 
     * @return void
     */
    public function testExecuteViewSuccess(): void
    {
        $result = $this->facade->executeView(['english_name' => 'testEnglishName']);

        $this->assertIsArray($result);
        $this->assertEquals('testEnglishName', $result['response']['data']['english_name']);
    }

    /**
     * 監督取得処理テスト-400
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
     * 監督取得処理テスト-204
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