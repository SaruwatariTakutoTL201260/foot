<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TeamResultsTable;
use Cake\TestSuite\TestCase;
use App\Library\AssertionLibrary;

/**
 * App\Model\Table\TeamResultsTable Test Case
 */
class TeamResultsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TeamResultsTable
     */
    protected $TeamResults;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.TeamResults',
        'app.Teams',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TeamResults') ? [] : ['className' => TeamResultsTable::class];
        $this->TeamResults = $this->getTableLocator()->get('TeamResults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TeamResults);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TeamResultsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TeamResultsTable::buildRules()
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
        $query = $this->TeamResults->find()
            ->find('active');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'TeamResults.is_deleted = 0',
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
        $query = $this->TeamResults->find()
            ->find('byId', [
                'id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'TeamResults.id = 1',
            $queryString,
            true,
        );
    }

    /**
     * 試合日時指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByMatchDate(): void
    {
        $query = $this->TeamResults->find()
            ->find('byMatchDate', [
                'match_date' => '2023-02-14 20:07:23',
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            "TeamResults.match_date < '2023-02-14 20:07:23'",
            $queryString,
        );
    }

    /**
     * チーム結果ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByTeamId(): void
    {
        $query = $this->TeamResults->find()
            ->find('byTeamId', [
                'team_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "TeamResults.team_id = 1",
            $queryString,
            true,
        );
    }

    /**
     * Teamsのcontainテスト(#615)
     *
     * @return void
     */
    public function testFindContainTeams(): void
    {
        $query = $this->TeamResults->find()
            ->find('containTeams');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            'INNER JOIN teams Teams ON (Teams.is_deleted = 0 AND Teams.id = TeamResults.team_id)',
            $queryString,
        );
    }
}
