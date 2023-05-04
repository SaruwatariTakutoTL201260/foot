<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MatchShedule Entity
 *
 * @property int $id
 * @property int $league_id
 * @property int $home_team_id
 * @property int $away_team_id
 * @property \Cake\I18n\FrozenTime|null $match_date
 * @property int|null $home_score
 * @property int|null $away_score
 * @property int $match_status
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\League $league
 */
class MatchShedule extends Entity
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
