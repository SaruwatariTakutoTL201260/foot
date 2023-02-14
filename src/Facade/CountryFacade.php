<?php
declare(strict_types=1);

namespace App\Facade;

use App\Constant\HttpCodeConstant;
use App\Model\Logic\CountryLogic;
use Throwable;

/**
 * 国facade
 * 
 * @package App\Facade
 */
class CountryFacade extends AppFacade
{
    protected CountryLogic $countryLogic;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        $this->countryLogic = new CountryLogic();
    }

    /**
     * 国一覧取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeIndex(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->countryLogic->fetchDataList($condition);

        return $this->generateResponse($result);
    }

    /**
     * 国取得Facade
     * 
     * @param array $condition 取得条件配列
     * @return array 処理結果配列
     */
    public function executeView(array $condition): array
    {
        // 条件に合うデータを取得
        $result = $this->countryLogic->fetchData($condition);

        return $this->generateResponse($result);
    }

    /**
     * 国登録Facade
     * 
     * @param array $params 登録データ配列
     * @return array 処理結果配列 
     */
    public function executeAdd(array $params): array
    {
        try {
            // データを登録
            $result = $this->countryLogic->insert($params);

            return $this->generateResponse($result);
        } catch (Throwable $e) {
            // 例外時
            $errorResult = [
                'code' => HttpCodeConstant::SERVER_ERROR,
                'data' => [$e->getMessage()],
            ];

            return $this->generateResponse($errorResult);
        }
    } 

    /**
     * 国編集Facade
     * 
     * @param array $condition 更新データ条件配列
     * @param array $params 更新データ配列
     * @return array 処理結果配列 
     */
    public function executeEdit(array $condition, array $params): array
    {
        try {
            // データを更新
            $result = $this->countryLogic->update($condition,$params);

            return $this->generateResponse($result);
        } catch (Throwable $e) {
            // 例外時
            $errorResult = [
                'code' => HttpCodeConstant::SERVER_ERROR,
                'data' => [$e->getMessage()],
            ];

            return $this->generateResponse($errorResult);
        }
    }

    /**
     * 国論理削除Facade
     * 
     * @param array $condition 削除データ条件配列
     * @return array 処理結果配列 
     */
    public function executeDelete(array $condition): array
    {
        try {
            // データを更新
            $result = $this->countryLogic->delete($condition);

            return $this->generateResponse($result);
        } catch (Throwable $e) {
            // 例外時
            $errorResult = [
                'code' => HttpCodeConstant::SERVER_ERROR,
                'data' => [$e->getMessage()],
            ];

            return $this->generateResponse($errorResult);
        }
    }
}