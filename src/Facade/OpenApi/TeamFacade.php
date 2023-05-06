<?php
declare(strict_types=1);

namespace App\Facade\OpenApi;

use App\Model\Logic\TeamLogic;
use Cake\Utility\Hash;

/**
 * チームfacade
 * 
 * @package App\Facade
 */
class TeamFacade extends \App\Facade\AppFacade
{
    protected TeamLogic $teamlogic;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        $this->teamlogic = new TeamLogic();
    }

    /**
     * チーム登録Facade
     * 
     * 存在しないチームを一括で登録
     * 
     * @param array $params 登録データ配列
     * @param int $leagueId 対象リーグid
     * @return array 処理結果配列
     */
    public function executeAdd(array $params, $leagueId): array
    {
        // 条件に合うデータを取得
        $fetchResult = $this->teamlogic->fetchDataList([
            'league_id' => (int)$leagueId
        ]);

        // 存在するチーム名を配列にまとめる
        $existGetIdList = Hash::extract($fetchResult["data"], "{n}.get_team_id");

        $params = Hash::map($params, "{n}", function ($item) use ($leagueId, $existGetIdList) {
            if (!empty($existGetIdList)) {
                // 対象リーグのデータがある場合に処理
                if (in_array((string)$item['team']['id'], $existGetIdList)) {
                    // すでにテーブルが存在する場合は登録しない
                    return null;
                }
            }

            // db設計に合うように整形
            return $this->teamlogic->mappingParams($item,(int)$leagueId);
        });

        // nullを削除
        $params = Hash::filter($params);
        
        // 登録処理実行
        $result = $this->teamlogic->insertAll($params);

        return $this->generateResponse($result);
    }
}