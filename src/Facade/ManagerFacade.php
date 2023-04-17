<?php
declare(strict_types=1);

namespace App\Facade;

use App\Model\Logic\ManagerLogic;

/**
 * 監督facade
 * 
 * @package App\Facade
 */
class ManagerFacade extends AppFacade
{
    protected ManagerLogic $managerLogic;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        $this->managerLogic = new ManagerLogic();
    }

    /**
     * 監督一覧取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeIndex(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->managerLogic->fetchDataList($condition);

        return $this->generateResponse($result);
    }

    /**
     * 監督取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeView(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->managerLogic->fetchData($condition);

        return $this->generateResponse($result);
    }
}