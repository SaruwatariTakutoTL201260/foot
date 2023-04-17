<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlayersFixture
 */
class PlayersFixture extends TestFixture
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
                'team_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'english_name' => 'Lorem ipsum dolor sit amet',
                'age' => 1,
                'number' => 1,
                'remark' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'modified' => '2023-02-16 16:32:51',
                'is_deleted' => 0,
                'position_status' => 1,
            ],
            [
                'id' => 2,
                'team_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'english_name' => 'Lorem ipsum dolor sit amet',
                'age' => 1,
                'number' => 1,
                'remark' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'modified' => '2023-02-16 16:32:51',
                'is_deleted' => 0,
                'position_status' => 3,
            ],
            [
                'id' => 3,
                'team_id' => 2,
                'name' => 'Lorem ipsum dolor sit amet',
                'english_name' => 'Lorem ipsum dolor sit amet',
                'age' => 1,
                'number' => 1,
                'remark' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'modified' => '2023-02-16 16:32:51',
                'is_deleted' => 0,
                'position_status' => 1,
            ],
            [
                'id' => 4,
                'team_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'english_name' => 'Lorem ipsum dolor sit amet',
                'age' => 1,
                'number' => 1,
                'remark' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'modified' => '2023-02-16 16:32:51',
                'is_deleted' => 1,
                'position_status' => 1,
            ],
            [
                'id' => 5,
                'team_id' => 1,
                'name' => 'testName',
                'english_name' => 'Lorem ipsum dolor sit amet',
                'age' => 1,
                'number' => 1,
                'remark' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'modified' => '2023-02-16 16:32:51',
                'is_deleted' => 0,
                'position_status' => 1,
            ],
        ];
        parent::init();
    }
}
