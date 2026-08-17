<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cities Model
 *
 * @property \App\Model\Table\CountriesTable&\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\CountiesTable&\Cake\ORM\Association\BelongsTo $Counties
 * @property \App\Model\Table\ClubsTable&\Cake\ORM\Association\HasMany $Clubs
 * @property \App\Model\Table\CompetitionsTable&\Cake\ORM\Association\HasMany $Competitions
 *
 * @method \App\Model\Entity\City newEmptyEntity()
 * @method \App\Model\Entity\City newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\City> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\City get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\City findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\City patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\City> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\City|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\City saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\City>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\City>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\City>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\City> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\City>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\City>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\City>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\City> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class CitiesTable extends Table
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

        $this->setTable('cities');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('CounterCache', [
            'Counties' => ['city_count'],
        ]);
        $this->addBehavior('KvAdmin.LocalizedData');

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Counties', [
            'foreignKey' => 'county_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Clubs', [
            'foreignKey' => 'city_id',
        ]);
        $this->hasMany('Competitions', [
            'foreignKey' => 'city_id',
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
            ->integer('country_id')
            ->notEmptyString('country_id');

        $validator
            ->nonNegativeInteger('county_id')
            ->notEmptyString('county_id');

        $validator
            ->scalar('shortname')
            ->maxLength('shortname', 10)
            ->requirePresence('shortname', 'create')
            ->notEmptyString('shortname');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('zip')
            ->maxLength('zip', 10)
            ->allowEmptyString('zip');

        $validator
            ->scalar('lat')
            ->maxLength('lat', 20)
            ->requirePresence('lat', 'create')
            ->notEmptyString('lat');

        $validator
            ->scalar('lng')
            ->maxLength('lng', 20)
            ->requirePresence('lng', 'create')
            ->notEmptyString('lng');

        $validator
            ->scalar('lat2')
            ->maxLength('lat2', 20)
            ->requirePresence('lat2', 'create')
            ->notEmptyString('lat2');

        $validator
            ->scalar('lng2')
            ->maxLength('lng2', 20)
            ->requirePresence('lng2', 'create')
            ->notEmptyString('lng2');

        $validator
            ->nonNegativeInteger('club_count')
            ->notEmptyString('club_count');

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
        $rules->add($rules->existsIn(['country_id'], 'Countries'), ['errorField' => 'country_id']);
        $rules->add($rules->existsIn(['county_id'], 'Counties'), ['errorField' => 'county_id']);

        return $rules;
    }
}
