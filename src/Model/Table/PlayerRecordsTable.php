<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Expression\QueryExpression;
use App\Constant\CodeConstant;

/**
 * PlayerRecords Model
 *
 * @property \App\Model\Table\LeaguesTable&\Cake\ORM\Association\BelongsTo $Leagues
 * @property \App\Model\Table\TeamsTable&\Cake\ORM\Association\BelongsTo $Teams
 * @property \App\Model\Table\PlayersTable&\Cake\ORM\Association\BelongsTo $Players
 *
 * @method \App\Model\Entity\PlayerRecord newEmptyEntity()
 * @method \App\Model\Entity\PlayerRecord newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlayerRecord[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlayerRecord get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlayerRecord findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlayerRecord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlayerRecord[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlayerRecord|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlayerRecord saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlayerRecord[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlayerRecord[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlayerRecord[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlayerRecord[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlayerRecordsTable extends Table
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

        $this->setTable('player_records');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Leagues', [
            'foreignKey' => 'league_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Players', [
            'foreignKey' => 'player_id',
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
            ->notEmptyString('team_id');

        $validator
            ->notEmptyString('player_id');

        $validator
            ->nonNegativeInteger('goal')
            ->notEmptyString('goal');

        $validator
            ->nonNegativeInteger('assist')
            ->notEmptyString('assist');

        $validator
            ->dateTime('match_date')
            ->allowEmptyDateTime('match_date');

        $validator
            ->nonNegativeInteger('yellow_card')
            ->notEmptyString('yellow_card');

        $validator
            ->nonNegativeInteger('red_card')
            ->notEmptyString('red_card');

        $validator
            ->boolean('is_injured')
            ->notEmptyString('is_injured');

        $validator
            ->boolean('is_suspension')
            ->notEmptyString('is_suspension');

        $validator
            ->scalar('remark')
            ->allowEmptyString('remark');

        $validator
            ->boolean('is_deleted')
            ->notEmptyString('is_deleted');

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
        $rules->add($rules->existsIn('team_id', 'Teams'), ['errorField' => 'team_id']);
        $rules->add($rules->existsIn('player_id', 'Players'), ['errorField' => 'player_id']);

        return $rules;
    }
    
    /**
     * ID指定選手成績カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findById(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('PlayerRecords.id', $options['id']);
        });
    }

    /**
     * 有効データ指定選手成績カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findActive(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('PlayerRecords.is_deleted', CodeConstant::NOT_DELETED);
        });
    }

    /**
     * ゴール数指定選手成績カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByGoal(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('PlayerRecords.goal', $options['goal']);
        });
    }

    /**
     * ゴールランキングカスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findOrderByGoal(Query $query): Query
    {
        return $query->order(['goal' => 'DESC']);
    }

    /**
     * アシスト数指定選手成績カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByAssist(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('PlayerRecords.assist', $options['assist']);
        });
    }

    /**
     * 試合日時指定選手成績カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByMatchDate(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->lt('PlayerRecords.match_date', $options['match_date']);
        });
    }

    /**
     * チームID指定カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByTeamId(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('PlayerRecords.team_id', $options['team_id']);
        });
    }

    /**
     * 選手登録ID指定カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByPlayerId(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('PlayerRecords.player_id', $options['player_id']);
        });
    }

    /**
     * リーグID指定カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByLeagueId(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('PlayerRecords.league_id', $options['league_id']);
        });
    }

    /**
     * TeamsとのContain
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
            return $q->where(['Teams.is_deleted' => CodeConstant::NOT_DELETED]);
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
            return $q->where(['Leagues.is_deleted' => CodeConstant::NOT_DELETED]);
        });
    }

    /**
     * PlayersとのContain
     *
     * 条件：Teamsテーブルのis_deletedがtrue(削除フラグが有効)の場合
     * generateQueryのベースクエリに上記をデフォルトで追加
     *
     * @param \Cake\ORM\Query $query ベースクエリ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findContainPlayers(Query $query): Query
    {
        return $query->contain('Players', function (Query $q) {
            return $q->where(['Players.is_deleted' => CodeConstant::NOT_DELETED]);
        });
    }
}
