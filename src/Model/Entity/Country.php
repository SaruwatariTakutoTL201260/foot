<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Constant\CountryConstant;
use Cake\ORM\Entity;

/**
 * Country Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property bool $is_deleted
 */
class Country extends Entity
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
        'converted_name',
    ];

    /**
     * 国名のアクセサー
     * 
     * @return null|string
     */
    protected function _getConvertedName(): ?string
    {
        if (!isset($this->id)) {
            return null;
        }

        return CountryConstant::COUNTRY_LIST[$this->id];
    }
}
