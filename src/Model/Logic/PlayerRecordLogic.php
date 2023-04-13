<?php
declare(strict_types=1);

namespace App\Model\Logic;

use App\Constant\HttpCodeConstant;
use App\Model\Logic\AppLogic;
use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 *  選手成績Logic
 * 
 * @package App\Model\Logic;
 * @property \Cake\ORM\Table $playerRecods
 */
class PlayerRecordLogic extends AppLogic
{
    /**
     * @var \Cake\ORM\Table 選手成績テーブル
     */
    protected Table $playerRecords;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        //Model設定
        $this->playerRecords = $this->getTableLocator()->get('PlayerRecords');
    }

    /**
     * 選手成績一覧取得処理
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
     * 選手成績取得処理
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
        $query = $this->playerRecords->find()
            ->find('active')
            ->find('containTeams')
            ->order(['match_date' => 'DESC']);

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

            if (isset($condition['goal'])) {
                // ゴール数を指定
                $query = $query->find('byGoal', [
                    'goal' => $condition['goal'],
                ]);
            }

            if (isset($condition['sort_goal'])) {
                // ゴール入れ替えフラグあり
                $query = $query->find('orderByGoal');
            }

            if (isset($condition['assist'])) {
                // アシスト数を指定
                $query = $query->find('byAssist', [
                    'assist' => $condition['assist'],
                ]);
            }

            if (isset($condition['match_date'])) {
                // 試合日時を指定
                $query = $query->find('byMatchDate', [
                    'match_date' => $condition['match_date'],
                ]);
            }

            if (isset($condition['team_id'])) {
                // チームIDを指定
                $query = $query->find('byTeamId', [
                    'team_id' => $condition['team_id']
                ]);
            }

            if (isset($condition['league_id'])) {
                // リーグIDを指定
                $query = $query->find('byLeagueId', [
                    'league_id' => $condition['league_id']
                ]);
            }

            if (isset($condition['player_id'])) {
                // 選手登録IDを指定
                $query = $query->find('byPlayerId', [
                    'player_id' => $condition['player_id']
                ]);
            }
        }

        return $query;
    }

}