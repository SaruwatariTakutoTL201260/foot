<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TeamsTable;
use Cake\TestSuite\TestCase;
use App\Library\AssertionLibrary;

/**
 * App\Model\Table\TeamsTable Test Case
 */
class TeamsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TeamsTable
     */
    protected $Teams;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Teams',
        'app.Leagues',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Teams') ? [] : ['className' => TeamsTable::class];
        $this->Teams = $this->getTableLocator()->get('Teams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Teams);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TeamsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TeamsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * 有効データ指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindActive(): void
    {
        $query = $this->Teams->find()
            ->find('active');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'Teams.is_deleted = 0',
            $queryString,
            true,
        );
    }

    /**
     * ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindById(): void
    {
        $query = $this->Teams->find()
            ->find('byId', [
                'id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'Teams.id = 1',
            $queryString,
            true,
        );
    }

    /**
     * IDリスト指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByIdList(): void
    {
        $query = $this->Teams->find()
            ->find('byIdList', [
                'id_list' => [1,2],
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            'Teams.id IN (1,2)',
            $queryString,
        );
    }

    /**
     * チーム名指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByName(): void
    {
        $query = $this->Teams->find()
            ->find('byName', [
                'name' => 'testName',
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Teams.name = 'testName'",
            $queryString,
            true,
        );
    }

    /**
     * リーグID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByCountryId(): void
    {
        $query = $this->Teams->find()
            ->find('byLeagueId', [
                'league_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Teams.league_id = 1",
            $queryString,
            true,
        );
    }

    /**
     * 取得ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByGetTeamId(): void
    {
        $query = $this->Teams->find()
            ->find('byGetTeamId', [
                'get_team_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Teams.get_team_id = 1",
            $queryString,
            true,
        );
    }

    /**
     * Companiesのcontainテスト(#615)
     *
     * @return void
     */
    public function testFindContainCustomers(): void
    {
        $query = $this->Teams->find()
            ->find('containLeagues');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            'INNER JOIN leagues Leagues ON (Leagues.is_deleted = 0 AND Leagues.id = Teams.league_id)',
            $queryString,
        );
    }
}
