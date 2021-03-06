<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tables Model
 *
 * @method \App\Model\Entity\Table get($primaryKey, $options = [])
 * @method \App\Model\Entity\Table newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Table[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Table|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Table saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Table patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Table[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Table findOrCreate($search, callable $callback = null, $options = [])
 */
class TablesTable extends Table
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

        $this->setTable('tables');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');

        $this->belongsTo('TableStatus',[
            'foreignKey' => 'TABLE_STATUS_ID'
        ]);

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
            ->integer('PERSON_QUANTITY')
            ->requirePresence('PERSON_QUANTITY', 'create')
            ->notEmptyString('PERSON_QUANTITY');

        $validator
            ->scalar('NAME')
            ->maxLength('NAME', 255)
            ->requirePresence('NAME', 'create')
            ->notEmptyString('NAME');

        $validator
            ->scalar('DESCRIPTION')
            ->maxLength('DESCRIPTION', 255)
            ->requirePresence('DESCRIPTION', 'create')
            ->notEmptyString('DESCRIPTION');

        $validator
            ->integer('TABLE_STATUS_ID')
            ->requirePresence('TABLE_STATUS_ID', 'create')
            ->notEmptyString('TABLE_STATUS_ID');

        return $validator;
    }
}
