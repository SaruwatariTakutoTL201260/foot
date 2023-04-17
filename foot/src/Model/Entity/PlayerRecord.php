<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlayerRecord Entity
 *
 * @property int $id
 * @property int $league_id
 * @property int $team_id
 * @property int $player_id
 * @property int $goal
 * @property int $assist
 * @property \Cake\I18n\FrozenTime|null $match_date
 * @property int $yellow_card
 * @property int $red_card
 * @property bool $is_injured
 * @property bool $is_suspension
 * @property string|null $remark
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\League $league
 * @property \App\Model\Entity\Team $team
 * @property \App\Model\Entity\Player $player
 */
class PlayerRecord extends Entity
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
