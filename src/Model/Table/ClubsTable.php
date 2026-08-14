<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clubs Model
 *
 * @property \App\Model\Table\CountriesTable&\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\CompetitionsTable&\Cake\ORM\Association\HasMany $Competitions
 * @property \App\Model\Table\SubclubsTable&\Cake\ORM\Association\HasMany $Subclubs
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 * @property \App\Model\Table\CompetitionsTable&\Cake\ORM\Association\BelongsToMany $Clubs
 *
 * @method \App\Model\Entity\Club newEmptyEntity()
 * @method \App\Model\Entity\Club newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Club> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Club get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Club findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Club patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Club> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Club|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Club saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Club>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Club>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Club>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Club> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Club>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Club>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Club>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Club> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class ClubsTable extends Table
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

        $this->setTable('clubs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Countries' => ['club_count'],
            'Cities' => ['club_count'],
        ]);

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Competitions', [
            'foreignKey' => 'club_id',
        ]);
        $this->hasMany('Subclubs', [
            'foreignKey' => 'club_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'club_id',
        ]);
        $this->belongsToMany('Clubs', [
            'foreignKey' => 'club_id',
            'targetForeignKey' => 'competition_id',
            'joinTable' => 'competitions_clubs',
            'className' => 'Competitions',
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
            ->nonNegativeInteger('country_id')
            ->notEmptyString('country_id');

        $validator
            ->nonNegativeInteger('city_id')
            ->notEmptyString('city_id');

        $validator
            ->scalar('clubpresident_id')
            ->maxLength('clubpresident_id', 36)
            ->requirePresence('clubpresident_id', 'create')
            ->notEmptyString('clubpresident_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('short_name')
            ->maxLength('short_name', 250)
            ->requirePresence('short_name', 'create')
            ->notEmptyString('short_name');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 255)
            ->allowEmptyString('logo');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->boolean('enabled')
            ->notEmptyString('enabled');

        $validator
            ->scalar('address')
            ->maxLength('address', 100)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 50)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->scalar('web')
            ->maxLength('web', 1000)
            ->requirePresence('web', 'create')
            ->notEmptyString('web');

        $validator
            ->scalar('facebook')
            ->maxLength('facebook', 1000)
            ->requirePresence('facebook', 'create')
            ->notEmptyString('facebook');

        $validator
            ->scalar('insta')
            ->maxLength('insta', 1000)
            ->requirePresence('insta', 'create')
            ->notEmptyString('insta');

        $validator
            ->boolean('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->notEmptyString('pos');

        $validator
            ->nonNegativeInteger('user_count')
            ->notEmptyString('user_count');

        $validator
            ->nonNegativeInteger('competition_count')
            ->notEmptyString('competition_count');

        $validator
            ->uuid('club_president_id')
            ->allowEmptyString('club_president_id');

        $validator
            ->date('national_membership_fee_date')
            ->allowEmptyDate('national_membership_fee_date');

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
        $rules->add($rules->existsIn(['city_id'], 'Cities'), ['errorField' => 'city_id']);

        return $rules;
    }
}
