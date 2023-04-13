<?php
declare(strict_types=1);

namespace App\Facade;

use App\Model\Logic\PlayerRecordLogic;

/**
 * 選手成績facade
 * 
 * @package App\Facade
 */
class PlayerRecordFacade extends AppFacade
{
    protected PlayerRecordLogic $playerRecordlogic;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        $this->playerRecordlogic = new PlayerRecordLogic();
    }

    /**
     * 選手成績一覧取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeIndex(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->playerRecordlogic->fetchDataList($condition);

        return $this->generateResponse($result);
    }

    /**
     * 選手成績取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeView(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->playerRecordlogic->fetchData($condition);

        return $this->generateResponse($result);
    }
}