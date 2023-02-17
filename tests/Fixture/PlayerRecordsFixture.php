<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlayerRecordsFixture
 */
class PlayerRecordsFixture extends TestFixture
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
                'team_id' => 1,
                'player_id' => 1,
                'goal' => 1,
                'assist' => 1,
                'match_date' => '2023-02-16 17:53:54',
                'yellow_card' => 1,
                'red_card' => 1,
                'is_injured' => 1,
                'is_suspension' => 1,
                'remark' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'modified' => '2023-02-16 17:53:54',
                'is_deleted' => 1,
            ],
        ];
        parent::init();
    }
}
