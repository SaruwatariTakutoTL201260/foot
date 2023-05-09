<?php
declare(strict_types=1);
namespace App\Shell;

use App\Constant\LeagueConstant;
use Cake\Console\Shell;
use Cake\Http\Client;
use App\Constant\OpenApiConstant;
use App\Facade\OpenApi\MatchScheduleFacade;
use Cake\Utility\Hash;

class MatchScheduleShell extends Shell
{
    protected MatchScheduleFacade $matchScheduleFacade;

    /**
     * コンストラクタ
     * 
     * リーグIDを引数とする
     */
    public function __construct()
    {
        parent::__construct();

        $this->matchScheduleFacade = new MatchScheduleFacade();
    }

    public function main()
    {
        $http = new Client();

        if (!isset($this->args[0])) {
            echo '引数を指定してください';
            exit;
        }

        // リーグID
        $leagueId = $this->args[0];

        // リーグIDが存在しない値のときはエラー
        if (!LeagueConstant::LEAGUE_GET_ID_LIST[$leagueId]) {
            echo '対象のリーグidを指定してください';
            exit;
        }

        // APIsportsのステータスエンドポイントにGETリクエストを送信
        $response = $http->get(OpenApiConstant::MATCH_SCHEDULE_ENDPOINT . "?league=" . LeagueConstant::LEAGUE_GET_ID_LIST[$leagueId]. "&season=2022&timezone=Asia/Tokyo", [], [
            'headers' => [
                'x-apisports-key' => OpenApiConstant::OPEN_API_KEY, // APIsportsの認証キーをヘッダーに追加
            ]
        ]);

        // responseのbodyを配列として代入
        $arrayResponse = json_decode((string)$response->getBody(), true);

        if (!Hash::check($arrayResponse, 'results')) {
            // 499(TimeOutもしくはサーバーエラー)
            echo $arrayResponse['message'];
            exit;
        }

        if (empty($arrayResponse['response'])) {
            // 対象のデータが見つからない場合
            echo '対象のデータが見つかりません';
            exit;
        }

        $result = $this->matchScheduleFacade->executeAdd($arrayResponse["response"], (int)$leagueId);

        // レスポンスボディを出力
        echo $result['response']['code'];
        echo $result['response']['data'];
    }
}
