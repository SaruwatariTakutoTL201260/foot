<?php
declare(strict_types=1);

namespace App\Traits;

use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\Log\Log;
use Psr\Log\LogLevel;

/**
 * ログ出力Trait
 *
 * デバッグ効率化のために作成<br>
 * 文字列だけではなく配列/ResultSetInterface/Entity等もログ出力可能
 *
 * @package App\Traits
 */
trait LoggerTrait
{
    /**
     * 文字列ログ出力
     *
     * パラメータで取得した文字列をログ出力<br>
     * 文字列/配列/EntityInterface/ResultSetInterface等をパラメータとして指定可能<br>
     * ログレベルに応じて出力されるログファイルが変更される<br>
     * ログレベルはAppConstant.phpに定数宣言済み
     *
     * @param array|string|EntityInterface|ResultSetInterface $message ログに書き込むメッセージ
     * @param string $level ログレベル(デフォルトはdebug.logに出力)
     * @param array $context ログスコープ
     * @return bool 処理結果(true：正常終了 / false：異常終了)
     */
    public function output(ResultSetInterface|array|string|EntityInterface $message, string $level = LogLevel::DEBUG, array $context = []): bool
    {
        return Log::write($level, print_r($message, true), $context);
    }
}
