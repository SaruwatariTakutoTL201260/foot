<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TeamsFixture
 */
class TeamsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'league_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'emblem' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'studium' => 'Lorem ipsum dolor sit amet',
                'modified' => '2023-02-14 17:39:08',
                'is_deleted' => 0,
            ],
            [
                'id' => 2,
                'league_id' => 2,
                'name' => 'testName',
                'emblem' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'studium' => 'Lorem ipsum dolor sit amet',
                'modified' => '2023-02-14 17:39:08',
                'is_deleted' => 0,
            ],
            [
                'id' => 3,
                'league_id' => 1,
                'name' => 'testName',
                'emblem' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'studium' => 'Lorem ipsum dolor sit amet',
                'modified' => '2023-02-14 17:39:08',
                'is_deleted' => 1,
            ],
        ];
        parent::init();
    }
}
