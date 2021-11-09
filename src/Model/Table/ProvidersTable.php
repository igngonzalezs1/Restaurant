<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Providers Model
 *
 * @method \App\Model\Entity\Provider get($primaryKey, $options = [])
 * @method \App\Model\Entity\Provider newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Provider[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Provider|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Provider saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Provider patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Provider[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Provider findOrCreate($search, callable $callback = null, $options = [])
 */
class ProvidersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('providers');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('ID')
            ->allowEmptyString('ID', null, 'create');

        $validator
            ->scalar('NAME')
            ->maxLength('NAME', 255)
            ->requirePresence('NAME', 'create')
            ->notEmptyString('NAME');

        return $validator;
    }
}
