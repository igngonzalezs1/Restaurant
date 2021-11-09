<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TableStatus Model
 *
 * @method \App\Model\Entity\TableStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\TableStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TableStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TableStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TableStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TableStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TableStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TableStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class TableStatusTable extends Table
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

        $this->setTable('table_status');
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
