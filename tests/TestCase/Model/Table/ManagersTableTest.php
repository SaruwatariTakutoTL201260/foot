<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ManagersTable;
use Cake\TestSuite\TestCase;
<<<<<<< HEAD
=======
use App\Library\AssertionLibrary;
>>>>>>> 3c2aab6 (確認)

/**
 * App\Model\Table\ManagersTable Test Case
 */
class ManagersTableTest extends TestCase
{
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
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Managers') ? [] : ['className' => ManagersTable::class];
        $this->Managers = $this->getTableLocator()->get('Managers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Managers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ManagersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ManagersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
<<<<<<< HEAD
=======

    /**
     * ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindById(): void
    {
        $query = $this->Managers->find()
            ->find('byId', [
                'id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'Managers.id = 1',
            $queryString,
            true,
        );
    }

    /**
     * 有効データ指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindActive(): void
    {
        $query = $this->Managers->find()
            ->find('active');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'Managers.is_deleted = 0',
            $queryString,
            true,
        );
    }

    /**
     * 監督名指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByName(): void
    {
        $query = $this->Managers->find()
            ->find('byName', [
                'name' => 'testName',
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Managers.name = 'testName'",
            $queryString,
            true,
        );
    }

    /**
     * 英語表記名指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByEnglishName(): void
    {
        $query = $this->Managers->find()
            ->find('byEnglishName', [
                'english_name' => 'testEnglishName',
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Managers.english_name = 'testEnglishName'",
            $queryString,
            true,
        );
    }

    /**
     * 年齢指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByAge(): void
    {
        $query = $this->Managers->find()
            ->find('byAge', [
                'age' => 20,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Managers.age = 20",
            $queryString,
            true,
        );
    }

    /**
     * 国ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByCountryID(): void
    {
        $query = $this->Managers->find()
            ->find('byCountryId', [
                'country_id' => 3,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Managers.country_id = 3",
            $queryString,
            true,
        );
    }

    /**
     * チームID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByTeamId(): void
    {
        $query = $this->Managers->find()
            ->find('byTeamId', [
                'team_id' => 4,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Managers.team_id = 4",
            $queryString,
            true,
        );
    }

    /**
     * 年齢指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByGetCouchId(): void
    {
        $query = $this->Managers->find()
            ->find('byGetCouchId', [
                'get_couch_id' => 2,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Managers.get_couch_id = 2",
            $queryString,
            true,
        );
    }

    /**
     * containテスト
     * 
     * @return void
     */
    public function testFindCntain(): void
    {
        $query = $this->Managers->find()
            ->find('containTeams')
            ->find('containCountries');

        $queryString = AssertionLibrary::getBindingQuery($query);

        // チームとのコンテイン
        $this->assertTextContains(
            'LEFT JOIN teams Teams ON (Teams.is_deleted = 0 AND Teams.id = Managers.team_id)',
            $queryString,
        );

        // 国とのコンテイン
        $this->assertTextContains(
            'INNER JOIN countries Countries ON (Countries.is_deleted = 0 AND Countries.id = Managers.country_id)',
            $queryString,
        );

    }
>>>>>>> 3c2aab6 (確認)
}
