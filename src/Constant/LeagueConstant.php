<?php
declare(strict_types=1);

namespace App\Constant;

/**
 * リーグ定数クラス
 * 
 * データベースでリーグは管理するが初期状態のために作成
 * 
 * @package App\Constant
*/
class LeagueConstant
{
    /**
     * リーグ名：J1
     * 
     * @var string
     */
    public const JAPAN_1 = '1';

    /**
     * リーグ名：J2
     * 
     * @var string
     */
    public const JAPAN_2 = '2';

    /**
     * リーグ名：プレミアリーグ
     * 
     * @var string
     */
    public const PREMIER = '3';

    /**
     * リーグ名：ラリーガ
     * 
     * @var string
     */
    public const LA_LIGA = '4';

    /**
     * リーグ名：ブンデスリーガ
     * 
     * @var string
     */
    public const BUNDESLIGA = '5';

    /**
     * リーグアン
     * 
     * @var string
     */
    public const LEAGUE_1 = '6';

    /**
     * セリエA
     * 
     * @var string
     */
    public const SERIE_A = '7';


    /**
     * リーグ名：プレミアリーグ
     * 
     * @var string
     */
    public const UCL = '8';

    /**
     * リーグ名：ヨーロッパリーグ
     * 
     * @var string
     */
    public const UEL = '9';

    /**
     * リーグ名リスト
     * 
     * @var string[]
     */
    public const LEAGUE_LIST = [
        self::JAPAN_1 => 'J1',
        self::JAPAN_2 => 'j2',
        self::PREMIER => 'プレミアリーグ',
        self::LA_LIGA => 'ラリーガ',
        self::BUNDESLIGA => 'ブンデスリーガ',
        self::LEAGUE_1 => 'リーグアン',
        self::SERIE_A => 'セリエA',
        self::UCL => 'UCL',
        self::UEL => 'UEL',
    ];
}