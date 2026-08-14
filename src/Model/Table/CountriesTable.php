<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 *
 * @property \App\Model\Table\ContinentsTable&\Cake\ORM\Association\BelongsTo $Continents
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\HasMany $Cities
 * @property \App\Model\Table\ClubsTable&\Cake\ORM\Association\HasMany $Clubs
 * @property \App\Model\Table\CompetitionTextTemplatesTable&\Cake\ORM\Association\HasMany $CompetitionTextTemplates
 * @property \App\Model\Table\CompetitionsTable&\Cake\ORM\Association\HasMany $Competitions
 * @property \App\Model\Table\CountiesTable&\Cake\ORM\Association\HasMany $Counties
 * @property \App\Model\Table\CountryVisibilitiesTable&\Cake\ORM\Association\HasMany $CountryVisibilities
 * @property \App\Model\Table\EmailTemplatesTable&\Cake\ORM\Association\HasMany $EmailTemplates
 * @property \App\Model\Table\EventLogsTable&\Cake\ORM\Association\HasMany $EventLogs
 * @property \App\Model\Table\SetupsTable&\Cake\ORM\Association\HasMany $Setups
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Country newEmptyEntity()
 * @method \App\Model\Entity\Country newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Country> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Country get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Country findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Country patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Country> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Country|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Country saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Country>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Country>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Country>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Country> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Country>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Country>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Country>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Country> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CountriesTable extends Table
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

        $this->setTable('countries');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Continents', [
            'foreignKey' => 'continent_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Cities', [
            'foreignKey' => 'country_id',
        ]);
        $this->hasMany('Clubs', [
            'foreignKey' => 'country_id',
        ]);
        $this->hasMany('CompetitionTextTemplates', [
            'foreignKey' => 'country_id',
        ]);
        $this->hasMany('Competitions', [
            'foreignKey' => 'country_id',
        ]);
        $this->hasMany('Counties', [
            'foreignKey' => 'country_id',
        ]);
        $this->hasMany('CountryVisibilities', [
            'foreignKey' => 'country_id',
        ]);
        $this->hasMany('EmailTemplates', [
            'foreignKey' => 'country_id',
        ]);
        $this->hasMany('EventLogs', [
            'foreignKey' => 'country_id',
        ]);
        $this->hasMany('Setups', [
            'foreignKey' => 'country_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'country_id',
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
            ->nonNegativeInteger('continent_id')
            ->notEmptyString('continent_id');

        $validator
            ->scalar('iso2')
            ->maxLength('iso2', 2)
            ->requirePresence('iso2', 'create')
            ->notEmptyString('iso2')
            ->add('iso2', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('endonim_name')
            ->maxLength('endonim_name', 150)
            ->requirePresence('endonim_name', 'create')
            ->notEmptyString('endonim_name');

        $validator
            ->scalar('locale')
            ->maxLength('locale', 10)
            ->requirePresence('locale', 'create')
            ->notEmptyString('locale');

        $validator
            ->scalar('timezone')
            ->maxLength('timezone', 64)
            ->notEmptyString('timezone');

        $validator
            ->scalar('phone_prefix')
            ->maxLength('phone_prefix', 16)
            ->notEmptyString('phone_prefix');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 255)
            ->allowEmptyString('logo');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 3)
            ->notEmptyString('currency');

        $validator
            ->boolean('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->notEmptyString('pos');

        $validator
            ->nonNegativeInteger('club_count')
            ->requirePresence('club_count', 'create')
            ->notEmptyString('club_count');

        $validator
            ->nonNegativeInteger('setup_count')
            ->notEmptyString('setup_count');

        $validator
            ->notEmptyString('user_count');

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
        $rules->add($rules->isUnique(['iso2']), ['errorField' => 'iso2']);
        $rules->add($rules->existsIn(['continent_id'], 'Continents'), ['errorField' => 'continent_id']);

        return $rules;
    }
}
