<?php
declare(strict_types=1);

namespace App\Test\TestCase\Facade\OpenApi;

use App\Facade\OpenApi\TeamFacade;
use Cake\TestSuite\TestCase;
use App\Model\Table\TeamsTable;

/**
 * TeamFacadeTest
 * 
 * @package App\Test\TestCase\Facade\OpenApi
 * @property TeamFacade $facade
 */
class TeamFacadeTest extends TestCase
{
    private TeamFacade $facade;

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
    public function setUp(): void
    {
        parent::setUp();

        $config = $this->getTableLocator()->exists('Teams') ? [] : ['className' => TeamsTable::class];
        $this->Teams = $this->getTableLocator()->get('Teams', $config);
        $this->facade = new TeamFacade();
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
     * 一括登録処理
     * 
     * @return void
     */
    public function testExecudeAdd(): void
    {
        $result = $this->facade->executeAdd([
            [
                'team' => [
                    'id' => (int) 33,
                    'name' => 'Manchester United',
                    'code' => 'MUN',
                    'country' => 'England',
                    'founded' => (int) 1878,
                    'national' => false,
                    'logo' => 'https://media-2.api-sports.io/football/teams/33.png'
                ],
                'venue' => [
                    'id' => (int) 556,
                    'name' => 'Old Trafford',
                    'address' => 'Sir Matt Busby Way',
                    'city' => 'Manchester',
                    'capacity' => (int) 76212,
                    'surface' => 'grass',
                    'image' => 'https://media-2.api-sports.io/football/venues/556.png'
                ]
            ],
            [
                'team' => [
                  'id' => (int) 63,
                  'name' => 'Leeds',
                  'code' => 'LEE',
                  'country' => 'England',
                  'founded' => (int) 1919,
                  'national' => false,
                  'logo' => 'https://media-3.api-sports.io/football/teams/63.png'
                ],
                'venue' => [
                  'id' => (int) 546,
                  'name' => 'Elland Road',
                  'address' => 'Elland Road',
                  'city' => 'Leeds, West Yorkshire',
                  'capacity' => (int) 40204,
                  'surface' => 'grass',
                  'image' => 'https://media-1.api-sports.io/football/venues/546.png'
                ]
            ],
            [
                'team' => [
                  'id' => (int) 49,
                  'name' => 'Lorem ipsum dolor sit amet',
                  'code' => 'CHE',
                  'country' => 'England',
                  'founded' => (int) 1905,
                  'national' => false,
                  'logo' => 'https://media-2.api-sports.io/football/teams/49.png'
                ],
                'venue' => [
                  'id' => (int) 519,
                  'name' => 'Stamford Bridge',
                  'address' => 'Fulham Road',
                  'city' => 'London',
                  'capacity' => (int) 41841,
                  'surface' => 'grass',
                  'image' => 'https://media-3.api-sports.io/football/venues/519.png'
                ]
              ],
            
        ], 1);
    }
}