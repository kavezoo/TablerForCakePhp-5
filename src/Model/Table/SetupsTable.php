<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Setups Model
 *
 * @method \App\Model\Entity\Setup newEmptyEntity()
 * @method \App\Model\Entity\Setup newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Setup> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Setup get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Setup findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Setup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Setup> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Setup|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Setup saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Setup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setup>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Setup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setup> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Setup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setup>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Setup>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Setup> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SetupsTable extends Table
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

        $this->setTable('setups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->scalar('type')
            ->maxLength('type', 20)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('edit_by')
            ->maxLength('edit_by', 20)
            ->notEmptyString('edit_by');

        $validator
            ->scalar('value')
            ->requirePresence('value', 'create')
            ->notEmptyString('value');

        $validator
            ->boolean('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->notEmptyString('pos');

        return $validator;
    }
}
