<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RecipeProducts Model
 *
 * @method \App\Model\Entity\RecipeProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\RecipeProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RecipeProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RecipeProduct|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RecipeProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RecipeProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RecipeProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RecipeProduct findOrCreate($search, callable $callback = null, $options = [])
 */
class RecipeProductsTable extends Table
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

        $this->setTable('recipe_products');
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
            ->integer('RECIPE_ID')
            ->requirePresence('RECIPE_ID', 'create')
            ->notEmptyString('RECIPE_ID');

        $validator
            ->integer('PROD_ID')
            ->requirePresence('PROD_ID', 'create')
            ->notEmptyString('PROD_ID');

        $validator
            ->integer('QUANTITE')
            ->allowEmptyString('QUANTITE');

        $validator
            ->integer('UNIT_ID')
            ->allowEmptyString('UNIT_ID');

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
