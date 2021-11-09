<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Date;
use \DateTime;
/**
 * SaleRequests Model
 *
 * @method \App\Model\Entity\SaleRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\SaleRequest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SaleRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SaleRequest|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SaleRequest saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SaleRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SaleRequest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SaleRequest findOrCreate($search, callable $callback = null, $options = [])
 */
class SaleRequestsTable extends Table
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

        $this->setTable('sale_requests');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');

        $this->belongsTo('Reservations',[
            'foreignKey' => 'RESER_ID'
        ]);
        $this->belongsTo('Recipes',[
            'foreignKey' => 'RECIPE_ID'
        ]);
        $this->belongsTo('SaleRequestStatus',[
            'foreignKey' => 'STATUS_ID'
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
            ->integer('PRICE_TOTAL')
            ->requirePresence('PRICE_TOTAL', 'create')
            ->notEmptyString('PRICE_TOTAL');

        $validator
            ->scalar('OBSERVATIONS')
            ->maxLength('OBSERVATIONS', 255)
            ->allowEmptyString('OBSERVATIONS');

        $validator
            ->scalar('CANCELATIONS')
            ->maxLength('CANCELATIONS', 255)
            ->allowEmptyString('CANCELATIONS');

        $validator
            ->dateTime('CREATED')
            ->requirePresence('CREATED', 'create')
            ->notEmptyDateTime('CREATED');

        $validator
            ->dateTime('MODIFICATE')
            ->requirePresence('MODIFICATE', 'create')
            ->notEmptyDateTime('MODIFICATE');

        $validator
            ->integer('RESER_ID')
            ->requirePresence('RESER_ID', 'create')
            ->notEmptyString('RESER_ID');

        $validator
            ->integer('RECIPE_ID')
            ->requirePresence('RECIPE_ID', 'create')
            ->notEmptyString('RECIPE_ID');

        $validator
            ->integer('STATUS_ID')
            ->requirePresence('STATUS_ID', 'create')
            ->notEmptyString('STATUS_ID');

        $validator
            ->integer('QUANTITY')
            ->allowEmptyString('QUANTITY');

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
