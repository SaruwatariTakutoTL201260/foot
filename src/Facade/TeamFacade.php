<?php
declare(strict_types=1);

namespace App\Facade;

use App\Model\Logic\TeamLogic;

/**
 * チームfacade
 * 
 * @package App\Facade
 */
class TeamFacade extends AppFacade
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
     * チーム一覧取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeIndex(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->teamlogic->fetchDataList($condition);

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
        $result = $this->teamlogic->fetchData($condition);

        return $this->generateResponse($result);
    }
}