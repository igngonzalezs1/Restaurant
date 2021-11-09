<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProviderRequest Model
 *
 * @method \App\Model\Entity\ProviderRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProviderRequest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProviderRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProviderRequest|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProviderRequest saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProviderRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProviderRequest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProviderRequest findOrCreate($search, callable $callback = null, $options = [])
 */
class ProviderRequestTable extends Table
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

        $this->setTable('provider_request');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');

        $this->hasMany('ProRequestProd',[
            'foreignKey' => 'PRO_REQ_ID',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->belongsTo('Providers',[
            'foreignKey' => 'PROV_ID'
        ]);
        $this->belongsTo('RequestProdStatus',[
            'foreignKey' => 'STATUS_ID'
        ]);
        $this->addBehavior('Search.Search');
        $this->searchManager()
        ->add('ID', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['ProviderRequest.ID' => $args['ID']]);
            }
        ])
        ->add('NAME_PROVIDER', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['Providers.NAME LIKE' => '%'.$args['NAME_PROVIDER'].'%']);
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
            ->integer('PROV_ID')
            ->requirePresence('PROV_ID', 'create')
            ->notEmptyString('PROV_ID');

        $validator
            ->integer('PRICE')
            ->requirePresence('PRICE', 'create')
            ->notEmptyString('PRICE');

        $validator
            ->integer('STATUS_ID')
            ->allowEmptyString('STATUS_ID');

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
