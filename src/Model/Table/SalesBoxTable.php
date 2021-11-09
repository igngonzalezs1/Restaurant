<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesBox Model
 *
 * @method \App\Model\Entity\SalesBox get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalesBox newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SalesBox[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalesBox|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesBox saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesBox patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalesBox[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalesBox findOrCreate($search, callable $callback = null, $options = [])
 */
class SalesBoxTable extends Table
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

        $this->setTable('sales_box');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');
        $this->addBehavior('Search.Search');
        $this->searchManager()
        ->add('ID', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['SalesBox.ID' => $args['ID']]);
            }
        ])
        ->add('DATE', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['SalesBox.CREATED' => $args['DATE']]);
            }
        ])
        ->add('DATEMONTH', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['extract (MONTH from SalesBox.CREATED) =' => $args['DATEMONTH']]);
            }
        ])
        ->add('DATEYEAR', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['extract (YEAR from SalesBox.CREATED) =' => $args['DATEYEAR']]);
            }
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
            ->integer('TOTAL_PRICE')
            ->requirePresence('TOTAL_PRICE', 'create')
            ->notEmptyString('TOTAL_PRICE');

        $validator
            ->scalar('COMMENTARY')
            ->maxLength('COMMENTARY', 255)
            ->requirePresence('COMMENTARY', 'create')
            ->notEmptyString('COMMENTARY');

        $validator
            ->scalar('ENTRY')
            ->maxLength('ENTRY', 1)
            ->requirePresence('ENTRY', 'create')
            ->notEmptyString('ENTRY');

        $validator
            ->integer('RESERVATION_ID')
            ->allowEmptyString('RESERVATION_ID');

        $validator
            ->dateTime('CREATED')
            ->allowEmptyDateTime('CREATED');

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
