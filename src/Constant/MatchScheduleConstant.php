<?php
declare(strict_types=1);

namespace App\Constant;

/**
 * 試合日程定数クラス
 * 
 * @package App\Constant
*/
class MatchScheduleConstant
{
    /**
     * 試合ステータスリスト
     * 
     * @var string[]
     */
    public const FIXTURE_MATCH_STATUS_LIST = [
        'TBD' => self::NOT_STARTED,
        'NS' => self::NOT_STARTED,
        '1H' => self::STARTED,
        'HT' => self::STARTED,
        'ET' => self::STARTED,
        '2H' => self::STARTED,
        'BT' => self::STARTED,
        'P' => self::STARTED,
        'INT' => self::STARTED,
        'SUSP' => self::BREAK,
        'FT' => self::FINISHED,
        'AET' => self::FINISHED,
        'PEN' => self::FINISHED,
        'PST' => self::DELAY,
        'CANC' => self::BREAK,
        'ABD' => self::BREAK,
        'AWD' => self::BREAK,
        'WO' => self::BREAK,
        'LIVE' => self::BREAK,
    ];

    /**
     * 試合ステータス:試合前
     * 
     * @var int
     */
    public const NOT_STARTED = 0;

    /**
     * 試合ステータス:試合中
     * 
     * @var int
     */
    public const STARTED = 1;

    /**
     * 試合ステータス:試合終了
     * 
     * @var int
     */
    public const FINISHED = 2;

    /**
     * 試合ステータス:試合延期
     * 
     * @var int
     */
    public const DELAY = 3;

    /**
     * 試合ステータス:試合中断
     * 
     * @var int
     */
    public const BREAK = 4;

    /**
     * 試合ステータス
     * 
     * @var string[]
     */
    public const MATCH_STATUS_LIST = [
        self::NOT_STARTED => '試合開始前',
        self::STARTED => '試合中',
        self::FINISHED => '試合終了',
        self::DELAY => '試合延期',
        self::BREAK => '試合中断',
    ];
}