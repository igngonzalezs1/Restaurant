<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProRequestProd Model
 *
 * @method \App\Model\Entity\ProRequestProd get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProRequestProd newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProRequestProd[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProRequestProd|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProRequestProd saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProRequestProd patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProRequestProd[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProRequestProd findOrCreate($search, callable $callback = null, $options = [])
 */
class ProRequestProdTable extends Table
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

        $this->setTable('pro_request_prod');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');
        $this->belongsTo('Products',[
            'foreignKey' => 'PROD_ID'
        ]);
        $this->belongsTo('UnitsOfWeights',[
            'foreignKey' => 'UNIT_ID'
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
            ->integer('PROD_ID')
            ->requirePresence('PROD_ID', 'create')
            ->notEmptyString('PROD_ID');

        $validator
            ->integer('QUANTITE')
            ->requirePresence('QUANTITE', 'create')
            ->notEmptyString('QUANTITE');

        $validator
            ->integer('UNIT_ID')
            ->allowEmptyString('UNIT_ID');

        $validator
            ->integer('PRO_REQ_ID')
            ->allowEmptyString('PRO_REQ_ID');

        return $validator;
    }

    public function beforeSave($event, $entity, $options){
        $id = $this->find('all',[
            'order' => ['ID'=>'asc']
        ])->last();
        if(!isset($entity->ID)){
            if(isset($id->ID)){
                $entity->ID = $id->ID+1;
            } else {
                $entity->ID = 0;
            }
        }
    }
}
