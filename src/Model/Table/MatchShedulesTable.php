<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Constant\CodeConstant;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MatchShedules Model
 *
 * @property \App\Model\Table\LeaguesTable&\Cake\ORM\Association\BelongsTo $Leagues
 *
 * @method \App\Model\Entity\MatchShedule newEmptyEntity()
 * @method \App\Model\Entity\MatchShedule newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MatchShedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MatchShedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\MatchShedule findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MatchShedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MatchShedule[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MatchShedule|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MatchShedule saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MatchShedule[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MatchShedule[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MatchShedule[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MatchShedule[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MatchShedulesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('match_shedules');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Leagues', [
            'foreignKey' => 'league_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Teams', [
            'foreignKey' => 'home_team_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('AwayTeams', [
            'className' => 'Teams',
            'foreignKey' => 'away_team_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('league_id');

        $validator
            ->requirePresence('home_team_id', 'create')
            ->notEmptyString('home_team_id');

        $validator
            ->requirePresence('away_team_id', 'create')
            ->notEmptyString('away_team_id');

        $validator
            ->dateTime('match_date')
            ->allowEmptyDateTime('match_date');

        $validator
            ->nonNegativeInteger('home_score')
            ->allowEmptyString('home_score');

        $validator
            ->nonNegativeInteger('away_score')
            ->allowEmptyString('away_score');

        $validator
            ->notEmptyString('match_status');

        $validator
            ->boolean('is_deleted')
            ->notEmptyString('is_deleted');

        $validator
            ->allowEmptyString('referee_id');

        $validator
            ->allowEmptyString('studium_id');
            
        $validator
            ->notEmptyString('get_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('league_id', 'Leagues'), ['errorField' => 'league_id']);

        return $rules;
    }

    /**
     * ID指定試合日程カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findById(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('MatchShedules.id', $options['id']);
        });
    }

    /**
     * 有効データ指定試合日程カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findActive(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('MatchShedules.is_deleted', CodeConstant::NOT_DELETED);
        });
    }

    /**
     * リーグID指定試合日程カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByLeagueId(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('MatchShedules.league_id', $options['league_id']);
        });
    }

    /**
     * ホームチームID指定試合日程カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByHomeTeamId(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('MatchShedules.home_team_id', $options['home_team_id']);
        });
    }

    /**
     * アウェイチームID指定試合日程カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByAwayTeamId(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('MatchShedules.away_team_id', $options['away_team_id']);
        });
    }

    /**
     * 試合ステータス指定試合日程カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByMatchStatus(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('MatchShedules.match_status', $options['match_status']);
        });
    }

    /**
     * 試合日時以前指定試合日程カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByBeforeMatchDate(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->lte('MatchShedules.match_date', $options['match_date']);
        });
    }

    /**
     * 試合日時以降指定試合日程カスタムファインダー
     * 
     * 試合日の１週間前までという条件を設定するため
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByAfterMatchDate(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->gte('MatchShedules.match_date', $options['match_date']);
        });
    }

    /**
     * ホーム得点指定試合日程カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByHomeScore(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('MatchShedules.home_score', $options['home_score']);
        });
    }

    /**
     * アウェイ得点指定試合日程カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByAwayScore(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('MatchShedules.away_score', $options['away_score']);
        });
    }

    /**
     * LeaguesとのContain
     *
     * 条件：Leaguesテーブルのis_deletedがtrue(削除フラグが有効)の場合
     * generateQueryのベースクエリに上記をデフォルトで追加
     *
     * @param \Cake\ORM\Query $query ベースクエリ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findContainLeagues(Query $query): Query
    {
        return $query->contain('Leagues', function (Query $q) {
            return $q->where(['Leagues.is_deleted' => 0]);
        });
    }

    /**
     * TeamsとのContain(Home)
     *
     * 条件：Teamsテーブルのis_deletedがtrue(削除フラグが有効)の場合
     * generateQueryのベースクエリに上記をデフォルトで追加
     *
     * @param \Cake\ORM\Query $query ベースクエリ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findContainTeams(Query $query): Query
    {
        return $query->contain('Teams', function (Query $q) {
            return $q->where(['Teams.is_deleted' => 0]);
        });
    }

    /**
     * TeamsとのContain(Away)
     *
     * 条件：Teamsテーブルのis_deletedがtrue(削除フラグが有効)の場合
     * generateQueryのベースクエリに上記をデフォルトで追加
     *
     * @param \Cake\ORM\Query $query ベースクエリ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findContainAwayTeams(Query $query): Query
    {
        return $query->contain('AwayTeams', function (Query $q) {
            return $q->where(['AwayTeams.is_deleted' => 0]);
        });
    }
}
