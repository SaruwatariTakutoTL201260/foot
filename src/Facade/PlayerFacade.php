<?php
declare(strict_types=1);

namespace App\Facade;

use App\Model\Logic\PlayerLogic;

/**
 * 選手登録facade
 * 
 * @package App\Facade
 */
class PlayerFacade extends AppFacade
{
    protected PlayerLogic $playerlogic;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        $this->playerlogic = new PlayerLogic();
    }

    /**
     * 選手登録一覧取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeIndex(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->playerlogic->fetchDataList($condition);

        return $this->generateResponse($result);
    }

    /**
     * 選手登録取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeView(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->playerlogic->fetchData($condition);

        return $this->generateResponse($result);
    }
}