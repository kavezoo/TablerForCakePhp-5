<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Continents Model
 *
 * @property \App\Model\Table\CountriesTable&\Cake\ORM\Association\HasMany $Countries
 *
 * @method \App\Model\Entity\Continent newEmptyEntity()
 * @method \App\Model\Entity\Continent newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Continent> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Continent get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Continent findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Continent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Continent> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Continent|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Continent saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Continent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Continent>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Continent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Continent> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Continent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Continent>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Continent>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Continent> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContinentsTable extends Table
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

        $this->setTable('continents');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Countries', [
            'foreignKey' => 'continent_id',
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
            ->scalar('code')
            ->maxLength('code', 3)
            ->requirePresence('code', 'create')
            ->notEmptyString('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 64)
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
        $rules->add($rules->isUnique(['code']), ['errorField' => 'code']);

        return $rules;
    }
}
