<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CountriesTable;
use Cake\TestSuite\TestCase;
use App\Library\AssertionLibrary;

/**
 * App\Model\Table\CountriesTable Test Case
 */
class CountriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CountriesTable
     */
    protected $Countries;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('Countries') ? [] : ['className' => CountriesTable::class];
        $this->Countries = $this->getTableLocator()->get('Countries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Countries);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CountriesTable::validationDefault()
     */
    public function testValidationDefault(): void
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
        $query = $this->Countries->find()
            ->find('active');

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'Countries.is_deleted = 0',
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
        $query = $this->Countries->find()
            ->find('byId', [
                'id' => 1,
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            'Countries.id = 1',
            $queryString,
            true,
        );
    }

    /**
     * 国名指定カスタムファインダーテスト
     * 
     * @return void
     */
    public function testFindByName(): void
    {
        $query = $this->Countries->find()
            ->find('byName', [
                'name' => 'testName',
            ]);

        $queryString = AssertionLibrary::getBindingQuery($query);

        $this->assertRegExpSql(
            "Countries.name = 'testName'",
            $queryString,
            true,
        );
    }
}
