<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UnitsOfWeights Model
 *
 * @method \App\Model\Entity\UnitsOfWeight get($primaryKey, $options = [])
 * @method \App\Model\Entity\UnitsOfWeight newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UnitsOfWeight[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UnitsOfWeight|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UnitsOfWeight saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UnitsOfWeight patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UnitsOfWeight[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UnitsOfWeight findOrCreate($search, callable $callback = null, $options = [])
 */
class UnitsOfWeightsTable extends Table
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

        $this->setTable('units_of_weights');
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

        $validator
            ->scalar('CODE')
            ->maxLength('CODE', 255)
            ->requirePresence('CODE', 'create')
            ->notEmptyString('CODE');

        return $validator;
    }
}
