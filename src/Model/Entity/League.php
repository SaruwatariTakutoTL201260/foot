<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * League Entity
 *
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\Country $country
 */
class League extends Entity
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
        'country_id' => true,
        'name' => true,
        'modified' => true,
        'is_deleted' => true,
        'country' => true,
    ];
}
