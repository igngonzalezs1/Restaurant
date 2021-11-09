<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * ProviderProducts Model
 *
 * @method \App\Model\Entity\ProviderProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProviderProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProviderProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProviderProduct|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProviderProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProviderProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProviderProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProviderProduct findOrCreate($search, callable $callback = null, $options = [])
 */
class ProviderProductsTable extends Table
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

        $this->setTable('provider_products');
        $this->setPrimaryKey('ID');

        $this->belongsTo('Products',[
            'foreignKey' => 'PRODUCT_ID'
        ]);
        $this->belongsTo('Providers',[
            'foreignKey' => 'PROVIDER_ID'
        ]);
        $this->belongsTo('UnitsOfWeights',[
            'foreignKey' => 'UNIT_ID'
        ]);
        $this->addBehavior('Search.Search');
        $this->searchManager()
        ->add('ID', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['ProviderProducts.ID' => $args['ID']]);
            }
        ])
        ->add('NAME', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['Products.NAME LIKE' => '%'.$args['NAME'].'%']);
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
            ->requirePresence('ID', 'create')
            ->notEmptyString('ID');

        $validator
            ->integer('QUANTITE')
            ->requirePresence('QUANTITE', 'create')
            ->notEmptyString('QUANTITE');

        $validator
            ->scalar('ACTIVE')
            ->maxLength('ACTIVE', 1)
            ->requirePresence('ACTIVE', 'create')
            ->notEmptyString('ACTIVE');

        $validator
            ->integer('PRICE')
            ->requirePresence('PRICE', 'create')
            ->notEmptyString('PRICE');

        $validator
            ->integer('PROVIDER_ID')
            ->requirePresence('PROVIDER_ID', 'create')
            ->notEmptyString('PROVIDER_ID');

        $validator
            ->integer('PRODUCT_ID')
            ->requirePresence('PRODUCT_ID', 'create')
            ->notEmptyString('PRODUCT_ID');

        $validator
            ->integer('UNIT_ID')
            ->requirePresence('UNIT_ID', 'create')
            ->notEmptyString('UNIT_ID');

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
