<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Competitions Model
 *
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\StaffsTable&\Cake\ORM\Association\HasMany $Staffs
 * @property \App\Model\Table\SubclubsTable&\Cake\ORM\Association\HasMany $Subclubs
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Competition newEmptyEntity()
 * @method \App\Model\Entity\Competition newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Competition> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Competition get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Competition findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Competition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Competition> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Competition|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Competition saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Competition>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Competition>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Competition>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Competition> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Competition>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Competition>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Competition>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Competition> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompetitionsTable extends Table
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

        $this->setTable('competitions');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Staffs', [
            'foreignKey' => 'competition_id',
        ]);
        $this->hasMany('Subclubs', [
            'foreignKey' => 'competition_id',
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'competition_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'competitions_users',
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
            ->nonNegativeInteger('organizing_club_id')
            ->requirePresence('organizing_club_id', 'create')
            ->notEmptyString('organizing_club_id');

        $validator
            ->nonNegativeInteger('city_id')
            ->notEmptyString('city_id');

        $validator
            ->scalar('venue_name')
            ->maxLength('venue_name', 250)
            ->requirePresence('venue_name', 'create')
            ->notEmptyString('venue_name');

        $validator
            ->scalar('venue_address')
            ->maxLength('venue_address', 255)
            ->notEmptyString('venue_address');

        $validator
            ->scalar('google_maps_url')
            ->maxLength('google_maps_url', 1000)
            ->notEmptyString('google_maps_url');

        $validator
            ->nonNegativeInteger('competition_text_template_id')
            ->allowEmptyString('competition_text_template_id');

        $validator
            ->uuid('modified_by')
            ->allowEmptyString('modified_by');

        $validator
            ->boolean('national_competition')
            ->notEmptyString('national_competition');

        $validator
            ->scalar('name')
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('title')
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('subtitle')
            ->maxLength('subtitle', 250)
            ->notEmptyString('subtitle');

        $validator
            ->scalar('subtitle2')
            ->maxLength('subtitle2', 250)
            ->notEmptyString('subtitle2');

        $validator
            ->date('first_date_of_application')
            ->requirePresence('first_date_of_application', 'create')
            ->notEmptyDate('first_date_of_application');

        $validator
            ->date('application_deadline')
            ->requirePresence('application_deadline', 'create')
            ->notEmptyDate('application_deadline');

        $validator
            ->dateTime('competition_datetime')
            ->requirePresence('competition_datetime', 'create')
            ->notEmptyDateTime('competition_datetime');

        $validator
            ->dateTime('start_datetime')
            ->allowEmptyDateTime('start_datetime');

        $validator
            ->dateTime('end_datetime')
            ->allowEmptyDateTime('end_datetime');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->nonNegativeInteger('minimum_team_size')
            ->notEmptyString('minimum_team_size');

        $validator
            ->nonNegativeInteger('lunch_for_the_attendant')
            ->notEmptyString('lunch_for_the_attendant');

        $validator
            ->scalar('racing_pipe_1_title')
            ->maxLength('racing_pipe_1_title', 250)
            ->notEmptyString('racing_pipe_1_title');

        $validator
            ->scalar('racing_pipe_2_title')
            ->maxLength('racing_pipe_2_title', 250)
            ->notEmptyString('racing_pipe_2_title');

        $validator
            ->scalar('racing_pipe_3_title')
            ->maxLength('racing_pipe_3_title', 250)
            ->notEmptyString('racing_pipe_3_title');

        $validator
            ->scalar('pipe_type')
            ->maxLength('pipe_type', 250)
            ->notEmptyString('pipe_type');

        $validator
            ->scalar('pipe_parameters')
            ->maxLength('pipe_parameters', 500)
            ->notEmptyString('pipe_parameters');

        $validator
            ->scalar('tobacco_type')
            ->maxLength('tobacco_type', 250)
            ->notEmptyString('tobacco_type');

        $validator
            ->decimal('tobacco_weight')
            ->notEmptyString('tobacco_weight');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 3)
            ->notEmptyString('currency');

        $validator
            ->decimal('entry_fee_member')
            ->notEmptyString('entry_fee_member');

        $validator
            ->decimal('entry_fee_non_member')
            ->notEmptyString('entry_fee_non_member');

        $validator
            ->scalar('lunch_description')
            ->maxLength('lunch_description', 500)
            ->notEmptyString('lunch_description');

        $validator
            ->decimal('lunch_price')
            ->notEmptyString('lunch_price');

        $validator
            ->decimal('racing_pipe_1_price_member')
            ->notEmptyString('racing_pipe_1_price_member');

        $validator
            ->decimal('racing_pipe_1_price_non_member')
            ->notEmptyString('racing_pipe_1_price_non_member');

        $validator
            ->decimal('racing_pipe_2_price_member')
            ->notEmptyString('racing_pipe_2_price_member');

        $validator
            ->decimal('racing_pipe_2_price_non_member')
            ->notEmptyString('racing_pipe_2_price_non_member');

        $validator
            ->decimal('racing_pipe_3_price_member')
            ->notEmptyString('racing_pipe_3_price_member');

        $validator
            ->decimal('racing_pipe_3_price_non_member')
            ->notEmptyString('racing_pipe_3_price_non_member');

        $validator
            ->scalar('racing_pipe_1_image')
            ->maxLength('racing_pipe_1_image', 255)
            ->notEmptyFile('racing_pipe_1_image');

        $validator
            ->scalar('racing_pipe_2_image')
            ->maxLength('racing_pipe_2_image', 255)
            ->notEmptyFile('racing_pipe_2_image');

        $validator
            ->scalar('racing_pipe_3_image')
            ->maxLength('racing_pipe_3_image', 255)
            ->notEmptyFile('racing_pipe_3_image');

        $validator
            ->nonNegativeInteger('user_count')
            ->allowEmptyString('user_count');

        $validator
            ->nonNegativeInteger('national_pipe_club_member_count')
            ->allowEmptyString('national_pipe_club_member_count');

        $validator
            ->nonNegativeInteger('attendant_count')
            ->allowEmptyString('attendant_count');

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
        $rules->add($rules->existsIn(['city_id'], 'Cities'), ['errorField' => 'city_id']);

        return $rules;
    }
}
