<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subclubs Model
 *
 * @property \App\Model\Table\ClubsTable&\Cake\ORM\Association\BelongsTo $Clubs
 * @property \App\Model\Table\CompetitionsTable&\Cake\ORM\Association\BelongsTo $Competitions
 * @property \App\Model\Table\CompetitionsUsersTable&\Cake\ORM\Association\HasMany $CompetitionsUsers
 *
 * @method \App\Model\Entity\Subclub newEmptyEntity()
 * @method \App\Model\Entity\Subclub newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Subclub> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subclub get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Subclub findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Subclub patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Subclub> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subclub|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Subclub saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Subclub>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Subclub>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Subclub>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Subclub> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Subclub>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Subclub>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Subclub>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Subclub> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubclubsTable extends Table
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

        $this->setTable('subclubs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clubs', [
            'foreignKey' => 'club_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Competitions', [
            'foreignKey' => 'competition_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('CompetitionsUsers', [
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
            ->nonNegativeInteger('club_id')
            ->notEmptyString('club_id');

        $validator
            ->scalar('competition_id')
            ->maxLength('competition_id', 36)
            ->notEmptyString('competition_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

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
        $rules->add($rules->existsIn(['club_id'], 'Clubs'), ['errorField' => 'club_id']);
        $rules->add($rules->existsIn(['competition_id'], 'Competitions'), ['errorField' => 'competition_id']);

        return $rules;
    }
}
