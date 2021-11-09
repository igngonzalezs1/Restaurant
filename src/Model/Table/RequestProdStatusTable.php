<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RequestProdStatus Model
 *
 * @method \App\Model\Entity\RequestProdStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\RequestProdStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RequestProdStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RequestProdStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequestProdStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequestProdStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RequestProdStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RequestProdStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class RequestProdStatusTable extends Table
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

        $this->setTable('request_prod_status');
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
            ->maxLength('NAME', 20)
            ->requirePresence('NAME', 'create')
            ->notEmptyString('NAME');

        return $validator;
    }
}
