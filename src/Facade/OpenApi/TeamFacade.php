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
        // 整形
        $params = Hash::map($params, "{n}", function ($item) use ($leagueId) {

            $teamResult = $this->teamlogic->fetchData([
                // 対象のチームデータを取得
                'get_team_id' => $item['team']['id'],
            ]);

            if ($teamResult['code'] === 200) {
                // すでにチームが存在するならnullを返す
                return null;
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