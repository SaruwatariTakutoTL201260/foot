<?php
declare(strict_types=1);

namespace App\Facade;

use App\Constant\HttpCodeConstant;
use App\Model\Logic\TeamLogic;
use App\Model\Logic\TeamResultLogic;

/**
 * リーグfacade
 * 
 * @package App\Facade
 */
class TeamResultFacade extends AppFacade
{
    protected TeamLogic $team;
    protected TeamResultLogic $teamResults;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        $this->team = new TeamLogic();
        $this->teamResults = new TeamResultLogic();
    }

    /**
     * チーム一覧取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeIndex(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->teamResults->fetchDataList($condition);

        return $this->generateResponse($result);
    }

    /**
     * チーム取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeView(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->teamResults->fetchData($condition);

        return $this->generateResponse($result);
    }

    /**
     * リーグ順位取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeScore(array $condition): array
    {
        // リーグIDに対応するチームを取得
        $teamIds = $this->team->fetchDataList([
            'league_id' => $condition['league_id'],
        ]);

        // 正常に取得できなかった場合はエラーレスポンスを返す
        if ($teamIds['code'] != HttpCodeConstant::SUCCESS) {
            return $this->generateResponse($teamIds);
        }

        // 空の配列を準備
        $result = [];
        $sort_winning_points = [];
        $sort_goals_score = [];
        $sort_score = [];


        foreach($teamIds['data'] as $key => $value) {
            // 全チームで順位表を取得
            $teamsResult = $this->teamResults->fetchData([
                'team_id' => $value->id,
                'match_date' => $condition['match_date']
            ]);

            if ($teamsResult['code'] != HttpCodeConstant::SUCCESS) {
                // 1チームでも取得失敗した場合エラーを返す
                return $this->generateResponse($teamsResult);
            }

            // 並び替えの基準を取得
            $sort_winning_points[] = $teamsResult['data']['winning_points'];
            $sort_goals_score[] = $teamsResult['data']['goals_score'];
            $sort_score[] = $teamsResult['data']['score'];

            $result = array_merge($result, [$key => $teamsResult['data']]);
        }

        // 勝ち点→得失点→総得点の順番で並び替え
        array_multisort(
            $sort_winning_points, SORT_DESC, 
            $sort_goals_score,  SORT_DESC,
            $sort_score, SORT_DESC,
            $result
        );
        
        // 処理結果を返す
        return $result;
    }
}