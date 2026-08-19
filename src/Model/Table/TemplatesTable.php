<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Templates Model
 *
 * @method \App\Model\Entity\Template newEmptyEntity()
 * @method \App\Model\Entity\Template newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Template> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Template get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Template findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Template patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Template> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Template|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Template saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Template>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Template>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Template>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Template> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Template>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Template>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Template>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Template> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TemplatesTable extends Table
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

        $this->setTable('templates');
        $this->setDisplayField('label');
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
            ->scalar('label')
            ->maxLength('label', 150)
            ->requirePresence('label', 'create')
            ->notEmptyString('label');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->boolean('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->notEmptyString('pos');

        return $validator;
    }
}
