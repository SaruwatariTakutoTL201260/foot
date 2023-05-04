<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MatchShedulesFixture
 */
class MatchShedulesFixture extends TestFixture
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
                'home_team_id' => 1,
                'away_team_id' => 1,
                'match_date' => '2023-04-18 16:50:50',
                'home_score' => 1,
                'away_score' => 1,
                'match_status' => 1,
                'modified' => '2023-04-18 16:50:50',
                'is_deleted' => 0,
            ],
            [
                'id' => 2,
                'league_id' => 2,
                'home_team_id' => 2,
                'away_team_id' => 4,
                'match_date' => '2033-04-18 16:50:50',
                'home_score' => 2,
                'away_score' => 2,
                'match_status' => 2,
                'modified' => '2033-04-18 16:50:50',
                'is_deleted' => 0,
            ],
            [
                'id' => 3,
                'league_id' => 2,
                'home_team_id' => 2,
                'away_team_id' => 2,
                'match_date' => '2043-04-18 16:50:50',
                'home_score' => 2,
                'away_score' => 2,
                'match_status' => 2,
                'modified' => '2033-04-18 16:50:50',
                'is_deleted' => 0,
            ],
        ];
        parent::init();
    }
}
