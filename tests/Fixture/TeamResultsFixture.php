<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TeamResultsFixture
 */
class TeamResultsFixture extends TestFixture
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
                'match_date' => '2023-02-12 20:07:23',
                'mache_number' => 0,
                'rank' => 1,
                'won' => 0,
                'lose' => 0,
                'tied' => 0,
                'score' => 0,
                'lost_point' => 0,
                'winning_points' => 0,
                'goals_score' => 0,
                'modified' => '2023-02-14 20:07:23',
                'is_deleted' => 0,
            ],
            [
                'id' => 2,
                'team_id' => 1,
                'match_date' => '2023-02-14 20:17:23',
                'mache_number' => 0,
                'rank' => 1,
                'won' => 0,
                'lose' => 0,
                'tied' => 0,
                'score' => 0,
                'lost_point' => 0,
                'winning_points' => 0,
                'goals_score' => 0,
                'modified' => '2023-02-14 20:07:23',
                'is_deleted' => 0,
            ],
            [
                'id' => 3,
                'team_id' => 2,
                'match_date' => '2023-02-10 20:07:23',
                'mache_number' => 0,
                'rank' => 2,
                'won' => 0,
                'lose' => 0,
                'tied' => 0,
                'score' => 0,
                'lost_point' => 0,
                'winning_points' => 0,
                'goals_score' => 0,
                'modified' => '2023-02-14 20:07:23',
                'is_deleted' => 0,
            ],
            [
                'id' => 4,
                'team_id' => 2,
                'match_date' => '2023-02-14 20:07:23',
                'mache_number' => 0,
                'rank' => 1,
                'won' => 0,
                'lose' => 0,
                'tied' => 0,
                'score' => 0,
                'lost_point' => 0,
                'winning_points' => 0,
                'goals_score' => 0,
                'modified' => '2023-02-14 20:07:23',
                'is_deleted' => 1,
            ],
            [
                'id' => 5,
                'team_id' => 1,
                'match_date' => '2023-02-04 20:07:23',
                'mache_number' => 0,
                'rank' => 1,
                'won' => 0,
                'lose' => 0,
                'tied' => 0,
                'score' => 0,
                'lost_point' => 0,
                'winning_points' => 0,
                'goals_score' => 0,
                'modified' => '2023-02-14 20:07:23',
                'is_deleted' => 0,
            ],
            [
                'id' => 6,
                'team_id' => 4,
                'match_date' => '2023-02-04 20:07:23',
                'mache_number' => 0,
                'rank' => 1,
                'won' => 0,
                'lose' => 0,
                'tied' => 0,
                'score' => 0,
                'lost_point' => 0,
                'winning_points' => 0,
                'goals_score' => 0,
                'modified' => '2023-02-14 20:07:23',
                'is_deleted' => 0,
            ],
        ];
        parent::init();
    }
}
