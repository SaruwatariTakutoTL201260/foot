<?php
declare(strict_types=1);
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Http\Client;
use App\Constant\OpenApiConstant;
use App\Facade\OpenApi\TeamFacade;
use App\Constant\LeagueConstant;

class TeamsShell extends Shell
{
    protected TeamFacade $teamFacade;

    /**
     * コンストラクタ
     * 
     * リーグIDを引数とする
     */
    public function __construct()
    {
        parent::__construct();

        $this->teamFacade = new TeamFacade();
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
        $response = $http->get(OpenApiConstant::TEAMS_ENDPOINT . "?league=" . LeagueConstant::LEAGUE_GET_ID_LIST[$leagueId] . "&season=2022", [], [
            'headers' => [
                'x-apisports-key' => OpenApiConstant::OPEN_API_KEY, // APIsportsの認証キーをヘッダーに追加
            ]
        ]);

        // responseのbodyを配列として代入
        $arrayResponse = json_decode((string)$response->getBody(), true);

        // 登録処理実行
        $result = $this->teamFacade->executeAdd($arrayResponse["response"], $leagueId);

        // レスポンスボディを出力
        echo $result['response']['data'];
    }
}
