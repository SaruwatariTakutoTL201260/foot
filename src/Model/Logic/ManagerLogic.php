<?php
declare(strict_types=1);

namespace App\Model\Logic;

use App\Constant\HttpCodeConstant;
use App\Model\Logic\AppLogic;
use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 *  監督Logic
 * 
 * @package App\Model\Logic;
 * @property \Cake\ORM\Table $managers
 */
class ManagerLogic extends AppLogic
{
    /**
     * @var \Cake\ORM\Table 監督テーブル
     */
    protected Table $managers;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        //Model設定
        $this->managers = $this->getTableLocator()->get('Managers');
    }

    /**
     * 監督一覧取得処理
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
     * 監督取得処理
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
     * 検索クエリ生成処理
     * 
     * @param array $condition
     * @return \Cake\ORM\Query $query
     */
    public function generateQuery($condition): Query
    {
        $query = $this->managers->find()
            ->find('active')
            ->find('containTeams')
            ->find('containCountries');

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
                // IDを指定
                $query = $query->find('byId', [
                    'id' => $condition['id'],
                ]);
            }

            if (isset($condition['name'])) {
                // 監督名を指定
                $query = $query->find('byName', [
                    'name' => $condition['name'],
                ]);
            }

            if (isset($condition['english_name'])) {
                // 英語表記名を指定
                $query = $query->find('byEnglishName', [
                    'english_name' => $condition['english_name'],
                ]);
            }

            if (isset($condition['age'])) {
                // 年齢を指定
                $query = $query->find('byAge', [
                    'age' => $condition['age'],
                ]);
            }

            if (isset($condition['country_id'])) {
                // 国IDを指定
                $query = $query->find('byCountryId', [
                    'country_id' => $condition['country_id']
                ]);
            }

            if (isset($condition['team_id'])) {
                // チームIDを指定
                $query = $query->find('byTeamId', [
                    'team_id' => $condition['team_id']
                ]);
            }

            if (isset($condition['get_couch_id'])) {
                // 取得監督IDを指定
                $query = $query->find('byGetCouchId', [
                    'get_couch_id' => $condition['get_couch_id']
                ]);
            }
        }

        return $query;
    }

}