<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TeamResult Entity
 *
 * @property int $id
 * @property int $team_id
 * @property \Cake\I18n\FrozenTime|null $match_date
 * @property int $mache_number
 * @property int $rank
 * @property int $won
 * @property int $lose
 * @property int $tied
 * @property int $score
 * @property int $lost_point
 * @property int $winning_points
 * @property int $goals_score
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\Team $team
 */
class TeamResult extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
