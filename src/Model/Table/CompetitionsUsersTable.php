<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompetitionsUsers Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CompetitionsTable&\Cake\ORM\Association\BelongsTo $Competitions
 * @property \App\Model\Table\SubclubsTable&\Cake\ORM\Association\BelongsTo $Subclubs
 *
 * @method \App\Model\Entity\CompetitionsUser newEmptyEntity()
 * @method \App\Model\Entity\CompetitionsUser newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CompetitionsUser> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionsUser get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CompetitionsUser findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CompetitionsUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CompetitionsUser> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionsUser|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CompetitionsUser saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CompetitionsUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CompetitionsUser>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CompetitionsUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CompetitionsUser> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CompetitionsUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CompetitionsUser>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CompetitionsUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CompetitionsUser> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompetitionsUsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('competitions_users');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Competitions', [
            'foreignKey' => 'competition_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Subclubs', [
            'foreignKey' => 'subclub_id',
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
            ->scalar('user_id')
            ->maxLength('user_id', 36)
            ->notEmptyString('user_id');

        $validator
            ->scalar('competition_id')
            ->maxLength('competition_id', 36)
            ->notEmptyString('competition_id');

        $validator
            ->nonNegativeInteger('subclub_id')
            ->allowEmptyString('subclub_id');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->notEmptyString('status');

        $validator
            ->nonNegativeInteger('lunch_for_the_attendant')
            ->allowEmptyString('lunch_for_the_attendant');

        $validator
            ->integer('companion_count')
            ->notEmptyString('companion_count');

        $validator
            ->scalar('special_lunch')
            ->maxLength('special_lunch', 250)
            ->allowEmptyString('special_lunch');

        $validator
            ->nonNegativeInteger('racing_pipe_1_qty')
            ->allowEmptyString('racing_pipe_1_qty');

        $validator
            ->nonNegativeInteger('racing_pipe_2_qty')
            ->allowEmptyString('racing_pipe_2_qty');

        $validator
            ->nonNegativeInteger('racing_pipe_3_qty')
            ->allowEmptyString('racing_pipe_3_qty');

        $validator
            ->scalar('comment')
            ->maxLength('comment', 250)
            ->allowEmptyString('comment');

        $validator
            ->dateTime('fee_paid_at')
            ->allowEmptyDateTime('fee_paid_at');

        $validator
            ->uuid('fee_paid_by')
            ->allowEmptyString('fee_paid_by');

        $validator
            ->decimal('entry_fee_amount')
            ->notEmptyString('entry_fee_amount');

        $validator
            ->decimal('racing_pipe_1_fee')
            ->notEmptyString('racing_pipe_1_fee');

        $validator
            ->decimal('racing_pipe_2_fee')
            ->notEmptyString('racing_pipe_2_fee');

        $validator
            ->decimal('racing_pipe_3_fee')
            ->notEmptyString('racing_pipe_3_fee');

        $validator
            ->decimal('lunch_fee')
            ->notEmptyString('lunch_fee');

        $validator
            ->decimal('fee_total')
            ->notEmptyString('fee_total');

        $validator
            ->decimal('result_time')
            ->allowEmptyString('result_time');

        $validator
            ->scalar('result_recorded_by_email')
            ->maxLength('result_recorded_by_email', 255)
            ->allowEmptyString('result_recorded_by_email');

        $validator
            ->nonNegativeInteger('result_rank')
            ->allowEmptyString('result_rank');

        $validator
            ->scalar('result_score')
            ->maxLength('result_score', 50)
            ->allowEmptyString('result_score');

        $validator
            ->scalar('result_note')
            ->maxLength('result_note', 250)
            ->allowEmptyString('result_note');

        $validator
            ->boolean('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->notEmptyString('pos');

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
        $rules->add($rules->isUnique(['competition_id', 'user_id']), ['errorField' => 'competition_id', 'message' => __('This combination of competition_id and user_id already exists')]);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['competition_id'], 'Competitions'), ['errorField' => 'competition_id']);
        $rules->add($rules->existsIn(['subclub_id'], 'Subclubs'), ['errorField' => 'subclub_id']);

        return $rules;
    }
}
