<?php 
declare(strict_types=1);

namespace App\Facade;
use App\Traits\LoggerTrait;

/**
 * Facade基盤
 * 
 * @package App\Facade
 */
class AppFacade
{
    // Trait
    use LoggerTrait;

    /**
     * コンストラクタ
     */
    public function __construct()
    {

    }

    /**
     * 処理結果レスポンス生成処理
     *
     * Controller側に返すレスポンスを生成
     * $resultListの中身は以下の通り
     *
     *  code int HTTPステータスコード
     *  data array レスポンスボディ(単一メッセージの場合も配列指定)
     *
     * @param array[] $resultList レスポンスデータ配列
     * @return array[] 生成した処理結果レスポンス
     */
    public function generateResponse(array $resultList = []): array
    {
        return [
            'response' => [
                'code' => $resultList['code'],
                'data' => $resultList['data'] ?? [],
            ],
        ];
    }
}