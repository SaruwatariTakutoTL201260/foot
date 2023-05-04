<?php
declare(strict_types=1);

namespace App\Model\Logic;

use App\Constant\HttpCodeConstant;
use App\Model\Logic\AppLogic;
use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 *  試合日程Logic
 * 
 * @package App\Model\Logic;
 * @property \Cake\ORM\Table $matchShedules
 */
class MatchSheduleLogic extends AppLogic
{
    /**
     * @var \Cake\ORM\Table 試合日程テーブル
     */
    protected Table $matchShedules;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();

        //Model設定
        $this->matchShedules = $this->getTableLocator()->get('MatchShedules');
    }

    /**
     * 試合日程一覧取得処理
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
     * 試合日程取得処理
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
        $query = $this->matchShedules->find()
            ->find('active')
            ->find('containTeams')
            ->find('containAwayTeams')
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
                // IDを指定
                $query = $query->find('byId', [
                    'id' => $condition['id'],
                ]);
            }

            if (isset($condition['match_status'])) {
                // 試合ステータスを指定
                $query = $query->find('byMatchStatus', [
                    'match_status' => $condition['match_status'],
                ]);
            }

            if (isset($condition['before_match_date'])) {
                // 試合日時以前を指定
                $query = $query->find('byBeforeMatchDate', [
                    'match_date' => $condition['before_match_date'],
                ]);
            }

            if (isset($condition['after_match_date'])) {
                // 試合日時以降を指定
                $query = $query->find('byAfterMatchDate', [
                    'match_date' => $condition['after_match_date'],
                ]);
            }

            if (isset($condition['home_score'])) {
                // ホーム得点を指定
                $query = $query->find('byHomeScore', [
                    'home_score' => $condition['home_score'],
                ]);
            }

            if (isset($condition['away_score'])) {
                // アウェイ得点を指定
                $query = $query->find('byAwayScore', [
                    'away_score' => $condition['away_score'],
                ]);
            }

            if (isset($condition['league_id'])) {
                // リーグIDを指定
                $query = $query->find('byLeagueId', [
                    'league_id' => $condition['league_id']
                ]);
            }

            if (isset($condition['home_team_id'])) {
                // ホームチームIDを指定
                $query = $query->find('byHomeTeamId', [
                    'home_team_id' => $condition['home_team_id']
                ]);
            }

            if (isset($condition['away_team_id'])) {
                // アウェイチームIDを指定
                $query = $query->find('byAwayTeamId', [
                    'away_team_id' => $condition['away_team_id']
                ]);
            }
        }

        return $query;
    }

}