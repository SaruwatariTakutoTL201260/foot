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
 * Leagues Model
 *
 * @property \App\Model\Table\CountriesTable&\Cake\ORM\Association\BelongsTo $Countries
 *
 * @method \App\Model\Entity\League newEmptyEntity()
 * @method \App\Model\Entity\League newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\League[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\League get($primaryKey, $options = [])
 * @method \App\Model\Entity\League findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\League patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\League[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\League|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\League saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\League[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\League[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\League[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\League[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LeaguesTable extends Table
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

        $this->setTable('leagues');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->notEmptyString('country_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

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
        $rules->add($rules->existsIn('country_id', 'Countries'), ['errorField' => 'country_id']);

        return $rules;
    }

    /**
     * ID?????????????????????????????????????????????
     * 
     * @param \Cake\ORM\Query $query ??????????????????
     * @param array $options ???????????????
     * @return \Cake\ORM\Query ?????????????????????
     */
    public function findById(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('Leagues.id', $options['id']);
        });
    }

    /**
     * ????????????????????????????????????????????????????????????
     * 
     * @param \Cake\ORM\Query $query ??????????????????
     * @param array $options ???????????????
     * @return \Cake\ORM\Query ?????????????????????
     */
    public function findActive(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('Leagues.is_deleted', CodeConstant::NOT_DELETED);
        });
    }

    /**
     * ????????????????????????????????????????????????
     * 
     * @param \Cake\ORM\Query $query ??????????????????
     * @param array $options ???????????????
     * @return \Cake\ORM\Query ?????????????????????
     */
    public function findByName(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('Leagues.name', $options['name']);
        });
    }

    /**
     * ???ID????????????????????????????????????
     * 
     * @param \Cake\ORM\Query $query ??????????????????
     * @param array $options ???????????????
     * @return \Cake\ORM\Query ?????????????????????
     */
    public function findByCountryId(Query $query, array $options=[]): Query
    {
        return $query->where(function (QueryExpression $exp) use ($options) {
            return $exp->eq('Leagues.country_id', $options['country_id']);
        });
    }

    /**
     * Countries??????Contain
     *
     * ?????????Countries???????????????is_deleted???true(????????????????????????)?????????
     * generateQuery?????????????????????????????????????????????????????????
     *
     * @param \Cake\ORM\Query $query ??????????????????
     * @return \Cake\ORM\Query ?????????????????????
     */
    public function findContainCountries(Query $query): Query
    {
        return $query->contain('Countries', function (Query $q) {
            return $q->where(['Countries.is_deleted' => 0]);
        });
    }
}
