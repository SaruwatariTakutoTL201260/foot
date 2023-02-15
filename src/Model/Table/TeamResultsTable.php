<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Expression\QueryExpression;
use App\Constant\CodeConstant;
use App\Constant\HttpCodeConstant;

/**
 * TeamResults Model
 *
 * @property \App\Model\Table\TeamsTable&\Cake\ORM\Association\BelongsTo $Teams
 *
 * @method \App\Model\Entity\TeamResult newEmptyEntity()
 * @method \App\Model\Entity\TeamResult newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TeamResult[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TeamResult get($primaryKey, $options = [])
 * @method \App\Model\Entity\TeamResult findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TeamResult patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TeamResult[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TeamResult|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TeamResult saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TeamResult[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TeamResult[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TeamResult[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TeamResult[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TeamResultsTable extends Table
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

        $this->setTable('team_results');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
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
            ->notEmptyString('team_id');

        $validator
            ->dateTime('match_date')
            ->allowEmptyDateTime('match_date');

        $validator
            ->notEmptyString('mache_number');

        $validator
            ->notEmptyString('rank');

        $validator
            ->notEmptyString('won');

        $validator
            ->notEmptyString('lose');

        $validator
            ->notEmptyString('tied');

        $validator
            ->notEmptyString('score');

        $validator
            ->notEmptyString('lost_point');

        $validator
            ->notEmptyString('winning_points');

        $validator
            ->notEmptyString('goals_score');

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
        $rules->add($rules->existsIn('team_id', 'Teams'), ['errorField' => 'team_id']);

        return $rules;
    }

    /**
     * ID指定チーム結果カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findById(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('TeamResults.id', $options['id']);
        });
    }

    /**
     * 有効データ指定チーム結果カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findActive(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('TeamResults.is_deleted', CodeConstant::NOT_DELETED);
        });
    }

    /**
     * 試合日時指定チーム結果カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByMatchDate(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->lt('TeamResults.match_date', $options['match_date']);
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
            return $exp->eq('TeamResults.team_id', $options['team_id']);
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
}
