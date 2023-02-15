<?php
declare(strict_types=1);

namespace App\Facade;

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
        $teamIds = $this->team->fetchDataList([
            'league_id' => $condition['league_id'],
        ]);

        $result = [];

        foreach($teamIds['data'] as $key => $value) {

            $teamsResult = $this->teamResults->fetchData([
                'team_id' => $value->id,
                'match_date' => $condition['match_date']
            ])['data'];

            $result = array_merge($result, [$key => $teamsResult]);
        }

        return $result;
    }
}