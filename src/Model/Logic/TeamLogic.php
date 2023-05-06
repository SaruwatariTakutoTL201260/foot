<?php
declare(strict_types=1);

namespace App\Model\Logic;

use App\Constant\CodeConstant;
use App\Constant\HttpCodeConstant;
use App\Model\Logic\AppLogic;
use App\Library\ConvertLibrary;

use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 *  チームLogic
 * 
 * @package App\Model\Logic;
 * @property \Cake\ORM\Table $teams
 */
class TeamLogic extends AppLogic
{
    /**
     * @var \Cake\ORM\Table チームテーブル
     */
    protected Table $teams;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        //Model設定
        $this->teams = $this->getTableLocator()->get('Teams');
    }

    /**
     * チーム一覧取得処理
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
     * チーム取得処理
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
     * チーム一括登録処理
     * 
     * @param array $params 登録データ配列
     * @return array 処理結果配列
     */
    public function insertAll(array $params): array
    {
        // 新規登録Entitiesを生成
        $entities = $this->teams->newEntities($params);

        // データ登録実行
        $result = $this->storeEntities($this->teams, $entities);

        // データ登録時エラーの場合
        if (!$result) {
            return [
                'code' => HttpCodeConstant::SERVER_ERROR,
                'data' => $this->generateMaltipleValidationErrorMessage($entities),
            ];
        }

        // 正常終了として処理結果を返す
        return [
            'code' => HttpCodeConstant::SUCCESS,
            'data' => '登録が完了しました',
        ];
    }

    /**
     * 登録パラメータ整形処理
     * 
     * @param array $params 登録情報配列
     * @param int $leagueId
     * @return array
     */
    public function mappingParams(array $params, int $leagueId): array
    {
        return [
            'get_team_id' => $params['team']['id'],
            'league_id' => $leagueId,
            'name' => $params['team']['name'],
            'studium' => $params['venue']['name'],
            'is_deleted' => CodeConstant::NOT_DELETED,
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
        $query = $this->teams->find()
            ->find('active')
            ->find('containLeagues');

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

            if (isset($condition['id_list'])) {
                //IDリストを指定
                $query = $query->find('byIdList', [
                    'id_list' => $condition['id_list'],
                ]);
            }

            if (isset($condition['league_id'])) {
                //リーグIDを指定
                $query = $query->find('byLeagueId', [
                    'league_id' => $condition['league_id']
                ]);
            }

            if (isset($condition['get_team_id'])) {
                // 取得チームIDを指定
                $query = $query->find('byGetTeamId', [
                    'get_team_id' => $condition['get_team_id']
                ]);
            }

            if (isset($condition['name'])) {
                //チーム名を指定
                $query = $query->find('byName', [
                    'name' => $condition['name']
                ]);
            }
        }

        return $query;
    }

}