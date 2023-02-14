<?php
declare(strict_types=1);

namespace App\Constant;

/**
 * Httpコードコンスタント
 * 
 * @package App\Constant
 */
class HttpCodeConstant
{
    /**
     * 処理成功(200)
     * 
     * @var int
     */
    public const SUCCESS = 200;

    /**
     * 返答コンテンツなし(204)
     * 
     * @var int
     */
    public const NO_CONTENT = 204;

    /**
     * 不正なリクエスト
     * 
     * @var int
     */
    public const BAD_REQUEST = 400;

    /**
     * アドレスページなし
     * 
     * @var int 
     */
    public const NOT_FOUND = 404;

    /**
     * サーバーエラー
     * 
     * @var int
     */
    public const SERVER_ERROR = 500;
}