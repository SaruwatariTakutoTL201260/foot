<?php
declare(strict_types=1);

namespace App\Constant;

/**
 * コード定数クラス
 * 
 * @package App\Constant
*/
class CodeConstant
{
    /**
     * 削除フラグ：未削除
     *
     * @var int
     */
    public const NOT_DELETED = 0;

    /**
     * 削除フラグ：削除済み
     *
     * @var int
     */
    public const DELETED = 1;
}