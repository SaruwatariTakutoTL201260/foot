<?php
declare(strict_types=1);

namespace App\Facade;

use App\Model\Logic\LeagueLogic;

/**
 * リーグfacade
 * 
 * @package App\Facade
 */
class LeagueFacade extends AppFacade
{
    protected LeagueLogic $leagueLogic;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        $this->leagueLogic = new LeagueLogic();
    }

    /**
     * リーグ一覧取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeIndex(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->leagueLogic->fetchDataList($condition);

        return $this->generateResponse($result);
    }

    /**
     * リーグ取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeView(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->leagueLogic->fetchData($condition);

        return $this->generateResponse($result);
    }
}