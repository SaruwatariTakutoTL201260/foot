<?php
declare(strict_types=1);

namespace App\Facade\OpenApi;

use App\Model\Logic\MatchSheduleLogic;
use App\Model\Logic\TeamLogic;
use Cake\Utility\Hash;

/**
 * 試合日程facade
 * 
 * @package App\Facade
 */
class MatchScheduleFacade extends \App\Facade\AppFacade
{
    protected MatchSheduleLogic $matchSchedule;
    protected TeamLogic $teamlogic;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        $this->matchSchedule = new MatchSheduleLogic();
        $this->teamlogic = new TeamLogic();
    }

    /**
     * チーム登録Facade
     * 
     * 存在しないチームを一括で登録
     * 
     * @param array $params 登録データ配列
     * @param int $leagueId 対象チームid
     * @return array 処理結果配列
     */
    public function executeAdd(array $params, int $leagueId): array
    {
        // DBに合うように配列をmapping
        $params = Hash::map($params, "{n}", function ($item) use ($leagueId) {
            // ホームチームのIDを取得
            $homeTeamId = $this->teamlogic->fetchData([
                'get_team_id' => $item['teams']['home']['id'],
            ]);
    
            // アウェイチームのIDを取得
            $awayTeamId = $this->teamlogic->fetchData([
                'get_team_id' => $item['teams']['away']['id'],
            ]);

            if ($homeTeamId['code'] != 200 || $awayTeamId['code'] != 200) {
                // 取得できなければエラーを返す
                return [
                    'code' => 500,
                    'data' => "ホームチームID:" . $item['teams']['home']['id'] . "もしくはアウェイチームID:" . $item['teams']['away']['id'] . "のコードが不適です。"
                ];
            }

            // db設計に合うように整形
            return $this->matchSchedule->mappingParams($item,(int)$leagueId,$homeTeamId['data']['id'],$awayTeamId['data']['id']);
        });

        if (Hash::check($params,'{n}.code')) {
            // エラーがある場合
            $errorResponse = Hash::extract($params,'{n}.data');
            return $this->generateResponse([
                'code' => 500,
                'data' => $errorResponse,
            ]);
        }

        // 登録処理実行
        $result = $this->matchSchedule->insertAll($params);

        return $this->generateResponse($result);
    }
}