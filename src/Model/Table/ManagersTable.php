<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Constant\CodeConstant;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Managers Model
 *
 * @property \App\Model\Table\TeamsTable&\Cake\ORM\Association\BelongsTo $Teams
 * @property \App\Model\Table\CountriesTable&\Cake\ORM\Association\BelongsTo $Countries
 *
 * @method \App\Model\Entity\Manager newEmptyEntity()
 * @method \App\Model\Entity\Manager newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Manager[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Manager get($primaryKey, $options = [])
 * @method \App\Model\Entity\Manager findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Manager patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Manager[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Manager|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Manager saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Manager[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Manager[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Manager[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Manager[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ManagersTable extends Table
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

        $this->setTable('managers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
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
            ->allowEmptyString('team_id');

        $validator
            ->notEmptyString('country_id');

        $validator
            ->allowEmptyString('get_couch_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('english_name')
            ->maxLength('english_name', 255)
            ->allowEmptyString('english_name');

        $validator
            ->notEmptyString('age');

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
        $rules->add($rules->existsIn('country_id', 'Countries'), ['errorField' => 'country_id']);

        return $rules;
    }

    /**
     * ID指定監督カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findById(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('Managers.id', $options['id']);
        });
    }

    /**
     * 有効データ指定国カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findActive(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('Managers.is_deleted', CodeConstant::NOT_DELETED);
        });
    }

    /**
     * 監督名指定国カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByName(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('Managers.name', $options['name']);
        });
    }

    /**
     * 英語表記名カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByEnglishName(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('Managers.english_name', $options['english_name']);
        });
    }

    /**
     * 年齢カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByAge(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('Managers.age', $options['age']);
        });
    }

    /**
     * 国ID指定カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByCountryId(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('Managers.country_id', $options['country_id']);
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
            return $exp->eq('Managers.team_id', $options['team_id']);
        });
    }

    /**
     * 取得監督ID指定カスタムファインダー
     * 
     * @param \Cake\ORM\Query $query ベースクエリ
     * @param array $options パラメータ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findByGetCouchId(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('Managers.get_couch_id', $options['get_couch_id']);
        });
    }

    /**
     * CountriesとのContain
     *
     * 条件：Countriesテーブルのis_deletedがtrue(削除フラグが有効)の場合
     * generateQueryのベースクエリに上記をデフォルトで追加
     *
     * @param \Cake\ORM\Query $query ベースクエリ
     * @return \Cake\ORM\Query 生成したクエリ
     */
    public function findContainCountries(Query $query): Query
    {
        return $query->contain('Countries', function (Query $q) {
            return $q->where(['Countries.is_deleted' => 0]);
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
            return $q->where(['Teams.is_deleted' => 0]);
        });
    }
}
