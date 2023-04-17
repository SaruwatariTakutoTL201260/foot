<?php
declare(strict_types=1);

namespace App\Model\Logic;

use App\Constant\CodeConstant;
use App\Constant\HttpCodeConstant;
use App\Library\ConvertLibrary;
use App\Model\Logic\AppLogic;
use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 * 国Logic
 * 
 * @package App\Model\Logic;
 * @property \Cake\ORM\Table $country
 */
class CountryLogic extends AppLogic
{
    /**
     * @var \Cake\ORM\Table 国テーブル
     */
    protected Table $country;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        //Model設定
        $this->country = $this->getTableLocator()->get('Countries');
    }

    /**
     * 国一覧取得処理
     * 
     * @param array $condition 取得条件
     * @return array 処理結果配列
     */
    public function fetchDataList(array $condition=[]): array
    {
        $result = $this->fetchResultSetInterface(
            $this->generateQuery($condition)
        );

        if (is_null($result)) {
            //条件に合うデータがない場合
            return [
                'code' => HttpCodeConstant::NO_CONTENT,
                'data' => [],
            ];
        }

        return [
            'code' => HttpCodeConstant::SUCCESS,
            'data' => $result->toArray(),
        ];
    }

    /**
     * 国取得処理
     * 
     * @param array $condition 取得条件
     * @return array 処理結果配列
     */
    public function fetchData(array $condition): array
    {
        // 取得条件未指定の場合はステータスコード400とエラーメッセージを配列で返す
        if (empty($condition)) {
            return [
                'code' => HttpCodeConstant::BAD_REQUEST,
                'data' => 'リクエストが不正です。'
            ];
        }

        $result = $this->fetchEntityInterface(
            $this->generateQuery($condition)
        );

        if (is_null($result)) {
            // 条件に合致するデータが存在しない場合、ステータスコード204を返す
            return [
                'code' => HttpCodeConstant::NO_CONTENT,
                'data' => [],
            ];
        }

        // ステータスコード200と取得したデータを配列化して返す
        return [
            'code' => HttpCodeConstant::SUCCESS,
            'data' => $result->toArray(),
        ];
    }

    /**
     * 国登録処理
     * 
     * @param array $params 登録データ配列
     * @return array 処理結果配列
     */
    public function insert(array $params): array
    {
        // パラメータをキャメルケースからスネークケースに変換
        $result = ConvertLibrary::convertToSnakeCase($params);

        // 新規登録Entityを生成
        $entity = $this->country->newEntity($params);

        // データ登録実行
        $result = $this->storeEntity($this->country, $entity);

        // データ登録時エラーの場合
        if (!$result) {
            return [
                'code' => HttpCodeConstant::SERVER_ERROR,
                'data' => $this->generateValidationErrorMessage($entity),
            ];
        }

        // 正常終了として処理結果を返す
        return [
            'code' => HttpCodeConstant::SUCCESS,
            'data' => '登録が完了しました',
        ];
    }

    /**
     * 国編集処理
     * 
     * @param array $condition 更新データ条件配列
     * @param array $params 更新データ配列
     * @return array 処理結果配列
     */
    public function update(array $condition, array $params): array
    {
        if (empty($condition)) {
            // 条件未設定
            return [
                'code' => HttpCodeConstant::BAD_REQUEST,
                'data' => '不正なリクエストです'
            ];
        }
        // パラメータをキャメルケースからスネークケースに変換
        $result = ConvertLibrary::convertToSnakeCase($params);

        // 条件に合致するEntityを取得
        $entity = $this->fetchEntityInterface(
            $this->generateQuery($condition)
        );

        if (is_null($entity)) {
            return [
                'code' => HttpCodeConstant::BAD_REQUEST,
                'data' => '更新対象が見つかりません',
            ];
        }

        // 更新Entityを生成
        $patchEntity = $this->createPatchEntity($this->country, $entity, $params);

        // データ更新実行
        $result = $this->storeEntity($this->country, $patchEntity);


        if (!$result) {
            // データ登録時エラーの場合
            return [
                'code' => HttpCodeConstant::SERVER_ERROR,
                'data' => $this->generateValidationErrorMessage($entity),
            ];
        }

        // 正常終了として処理結果を返す
        return [
            'code' => HttpCodeConstant::SUCCESS,
            'data' => '更新しました',
        ];
    }

    /**
     * 国論理削除処理
     * 
     * @param array $condition 処理条件配列
     * @return array 処理結果配列
     */
    public function delete(array $condition): array
    {
        if (empty($condition)) {
            // 条件未設定
            return [
                'code' => HttpCodeConstant::BAD_REQUEST,
                'data' => '不正なリクエストです'
            ];
        }

        // 条件にあったEntity取得
        $entity = $this->fetchEntityInterface(
            $this->generateQuery($condition)
        );

        if (is_null($entity)) {
            return [
                'code' => HttpCodeConstant::NO_CONTENT,
                'data' => [],
            ];
        }

        // 削除フラグセット
        $params = [
            'is_deleted' => CodeConstant::DELETED,
        ];

        // 削除対象Entity生成
        $patchEntity = $this->createPatchEntity($this->country, $entity, $params);

        // データ論理削除実行
        $result = $this->storeEntity($this->country, $patchEntity);

        if (!$result) {
            // データ削除時エラーの場合
            return [
                'code' => HttpCodeConstant::SERVER_ERROR,
                'data' => $this->generateValidationErrorMessage($entity),
            ];
        }

        return [
            'code' => HttpCodeConstant::SUCCESS,
            'data' => '削除しました',
        ];
    }

    /**
     * 検索クエリ生成処理
     * 
     * @param array $condition
     * @return \Cake\ORM\Query $query
     */
    public function generateQuery($condition): Query
    {
        $query = $this->country->find()
            ->find('active');

        return $this->generateCondition($query, $condition);
    }

    /**
     * 条件クエリ生成処理
     * 
     * @param \Cake\ORM\Query $query　ベースクエリ
     * @param array $condition 条件配列
     * @return \Cake\ORM\Query 生成されたクエリ
     */
    public function generateCondition(Query $query, array $condition): Query
    {
        if (!empty($condition)) {
            if (isset($condition['id'])) {
                //IDを指定
                $query = $query->find('byId', [
                    'id' => $condition['id'],
                ]);
            }

            if (isset($condition['name'])) {
                //国名を指定
                $query = $query->find('byName', [
                    'name' => $condition['name']
                ]);
            }
        }

        return $query;
    }

}