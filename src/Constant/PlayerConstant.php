<?php
declare(strict_types=1);

namespace App\Constant;

/**
 * リーグ定数クラス
 * 
 * @package App\Constant
*/
class PlayerConstant
{
    /**
     * ポジション名：GK
     * 
     * @var int
     */
    public const GK = 0;

    /**
     * ポジション名：DF
     * 
     * @var int
     */
    public const DF = 1;

    /**
     * ポジション名：MF
     * 
     * @var int
     */
    public const MF = 2;

    /**
     * ポジション名：FW
     * 
     * @var int
     */
    public const FW = 3;

    /**
     * リーグ名リスト
     * 
     * @var string[]
     */
    public const LEAGUE_LIST = [
        self::GK => 'GK',
        self::DF => 'DF',
        self::MF => 'MF',
        self::FW => 'FW',
    ];

    /**
     * 怪我フラグ：怪我なし
     * 
     * @var int
     */
    public const NOT_INJURED = 0;

    /**
     * 怪我フラグ：負傷中
     * 
     * @var int
     */
    public const INJURED = 1;

    /**
     * 怪我フラグリスト
     * 
     * @var string[]
     */
    public const INJURED_LIST = [
        self::NOT_INJURED => '怪我なし',
        self::INJURED => '負傷中',
    ];

    /**
     * 出場停止フラグ：出場可能
     * 
     * @var int
     */
    public const NOT_SUSPENSION = 0;

    /**
     * 出場停止フラグ：出場停止
     * 
     * @var int
     */
    public const SUSPENSION = 1;

    /**
     * 出場停止フラグリスト
     * 
     * @var string[]
     */
    public const SUSPENSION_LIST = [
        self::NOT_INJURED => '出場可能',
        self::INJURED => '出場停止',
    ];
}