<?php
declare(strict_types=1);

namespace App\Test\TestCase\Facade\OpenApi;

use App\Facade\OpenApi\MatchScheduleFacade;
use App\Model\Table\MatchShedulesTable;
use Cake\TestSuite\TestCase;
use App\Model\Table\TeamsTable;

/**
 * TeamFacadeTest
 * 
 * @package App\Test\TestCase\Facade\OpenApi
 * @property MatchscheduleFacade $facade
 */
class MatchScheduleFacadeTest extends TestCase
{
    private MatchScheduleFacade $facade;

    /**
     * Test subject
     *
     * @var \App\Model\Table\MatchShedulesTable
     */
    protected $MatchShedules;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Teams',
        'app.Leagues',
        'app.MatchShedules',
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
        $this->MatchShedules = $this->getTableLocator()->get('MatchShedules', $config);
        $this->facade = new MatchScheduleFacade();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->MatchShedules);

        parent::tearDown();
    }

    /**
     * 一括登録処理-sucess
     * 
     * @return void
     */
    public function testExecudeAdd(): void
    {
        $result = $this->facade->executeAdd([
            [
                'fixture' => [
                    'id' => (int) 1,
                    'referee' => 'P. Bankes',
                    'timestamp' => (int) 1683482400,
                    'venue' => [
                        'id' => (int) 2,
                    ],
                    'status' => [
                        'short' => 'NS',
                    ]
                ],
                'teams' => [
                    'home' => [
                        'id' => (int) 1,
                    ],
                    'away' => [
                        'id' => (int) 2,
                    ]
                ],
                'goals' => [
                    'home' => null,
                    'away' => null
                ],
            ],
            [
                'fixture' => [
                    'id' => (int) 1,
                    'referee' => 'S. Attwell',
                    'timestamp' => (int) 1683381600,
                    'venue' => [
                        'id' => (int) 1,
                    ],
                    'status' => [
                        'short' => 'NS',
                    ]
                ],
                'teams' => [
                    'home' => [
                        'id' => (int) 1,
                    ],
                    'away' => [
                        'id' => (int) 2,
                    ]
                ],
                'goals' => [
                    'home' => null,
                    'away' => null
                ],
            ],          
        ], 1);

        $this->assertIsArray($result);
        $this->assertEquals('200', $result['response']['code']);
    }

    /**
     * 一括登録処理-erorr
     * 
     * @return void
     */
    public function testExecudeAddErorr(): void
    {
        $result = $this->facade->executeAdd([
            [
                'fixture' => [
                    'id' => (int) 1,
                    'referee' => 'P. Bankes',
                    'timestamp' => (int) 1683482400,
                    'venue' => [
                        'id' => (int) 2,
                    ],
                    'status' => [
                        'short' => 'NS',
                    ]
                ],
                'teams' => [
                    'home' => [
                        'id' => (int) 1,
                    ],
                    'away' => [
                        'id' => (int) 2,
                    ]
                ],
                'goals' => [
                    'home' => null,
                    'away' => null
                ],
            ],
            [
                'fixture' => [
                    'id' => (int) 1,
                    'referee' => 'S. Attwell',
                    'timestamp' => (int) 1683381600,
                    'venue' => [
                        'id' => (int) 1,
                    ],
                    'status' => [
                        'short' => 'NS',
                    ]
                ],
                'teams' => [
                    'home' => [
                        'id' => (int) 49,
                    ],
                    'away' => [
                        'id' => (int) 2,
                    ]
                ],
                'goals' => [
                    'home' => null,
                    'away' => null
                ],
            ],          
        ], 1);

        $this->assertIsArray($result);
        $this->assertEquals('500', $result['response']['code']);
    }
}