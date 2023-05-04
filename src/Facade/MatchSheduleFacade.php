<?php
declare(strict_types=1);

namespace App\Facade;

use App\Model\Logic\MatchSheduleLogic;

/**
 * 試合日程facade
 * 
 * @package App\Facade
 */
class MatchSheduleFacade extends AppFacade
{
    protected MatchSheduleLogic $matchShedulesLogic;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        $this->matchShedulesLogic = new MatchSheduleLogic();
    }

    /**
     * 試合日程一覧取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeIndex(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->matchShedulesLogic->fetchDataList($condition);

        return $this->generateResponse($result);
    }

    /**
     * 試合日程取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeView(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->matchShedulesLogic->fetchData($condition);

        return $this->generateResponse($result);
    }
}