<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Constant\MatchScheduleConstant;
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
 * @property int $get_id
 * @property int|null $referee_id
 *  @property int|null $studium_id
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

    /**
     * 仮想属性
     * 
     * @ver array
     */
    protected $_virtual = [
        'match_stasus',
    ];

    /**
     * 国名のアクセサー
     * 
     * @return null|string
     */
    protected function _getConvertedMatchStatus(): ?string
    {
        if (!isset($this->match_status)) {
            return null;
        }

        return MatchScheduleConstant::MATCH_STATUS_LIST[$this->match_status];
    }
}
