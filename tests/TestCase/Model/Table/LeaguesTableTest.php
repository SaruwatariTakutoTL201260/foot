<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeaguesTable;
use Cake\TestSuite\TestCase;
use App\Library\AssertionLibrary;

/**
 * App\Model\Table\LeaguesTable Test Case
 */
class LeaguesTableTest extends TestCase
{
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
        'app.Leagues',
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
        $config = $this->getTableLocator()->exists('Leagues') ? [] : ['className' => LeaguesTable::class];
        $this->Leagues = $this->getTableLocator()->get('Leagues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Leagues);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LeaguesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LeaguesTable::buildRules()
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
        $query = $this->Leagues->find()
            ->find('active');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'Leagues.is_deleted = 0',
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
        $query = $this->Leagues->find()
            ->find('byId', [
                'id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'Leagues.id = 1',
            $queryString,
            true,
        );
    }

    /**
     * リーグ名指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByName(): void
    {
        $query = $this->Leagues->find()
            ->find('byName', [
                'name' => 'testName',
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Leagues.name = 'testName'",
            $queryString,
            true,
        );
    }

    /**
     * 国ID指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByCountryId(): void
    {
        $query = $this->Leagues->find()
            ->find('byCountryId', [
                'country_id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Leagues.country_id = 1",
            $queryString,
            true,
        );
    }

    /**
     * Companies、Productsのcontainテスト(#615)
     *
     * @return void
     */
    public function testFindContainCustomers(): void
    {
        $query = $this->Leagues->find()
            ->find('containCountries');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertTextContains(
            'INNER JOIN countries Countries ON (Countries.is_deleted = 0 AND Countries.id = Leagues.country_id)',
            $queryString,
        );
    }
}
