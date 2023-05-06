<?php
declare(strict_types=1);
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Http\Client;
use App\Constant\OpenApiConstant;

class LeaguesShell extends Shell
{
    public function main()
    {
        $http = new Client();

        // APIsportsのステータスエンドポイントにGETリクエストを送信
        $response = $http->get('https://v3.football.api-sports.io/leagues', [], [
            'headers' => [
                'x-apisports-key' => OpenApiConstant::OPEN_API_KEY, // APIsportsの認証キーをヘッダーに追加
            ]
        ]);

        // レスポンスボディを出力
        echo $response->getBody();
    }
}
