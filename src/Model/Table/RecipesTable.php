<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Recipes Model
 *
 * @method \App\Model\Entity\Recipe get($primaryKey, $options = [])
 * @method \App\Model\Entity\Recipe newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Recipe[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Recipe|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Recipe saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Recipe patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Recipe[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Recipe findOrCreate($search, callable $callback = null, $options = [])
 */
class RecipesTable extends Table
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
        $this->addBehavior('Search.Search');

        $this->setTable('recipes');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');
        $this->hasMany('RecipeProducts',[
            'foreignKey' => 'PROD_ID'
        ]);
        $this->addBehavior('Search.Search');
        $this->searchManager()
        ->add('ID', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['Recipes.ID' => $args['ID']]);
            }
        ])
        ->add('NAME', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['Recipes.NAME LIKE' => '%'.$args['NAME'].'%']);
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
            ->scalar('NAME')
            ->maxLength('NAME', 255)
            ->requirePresence('NAME', 'create')
            ->notEmptyString('NAME');

        $validator
            ->integer('PRICE')
            ->requirePresence('PRICE', 'create')
            ->notEmptyString('PRICE');

        $validator
            ->scalar('DESCRIPTION')
            ->maxLength('DESCRIPTION', 255)
            ->requirePresence('DESCRIPTION', 'create')
            ->notEmptyString('DESCRIPTION');

        $validator
            ->integer('PREPARATION_TIME')
            ->requirePresence('PREPARATION_TIME', 'create')
            ->notEmptyString('PREPARATION_TIME');

        $validator
            ->scalar('MOD_PREPARATION')
            ->maxLength('MOD_PREPARATION', 255)
            ->requirePresence('MOD_PREPARATION', 'create')
            ->notEmptyString('MOD_PREPARATION');

        $validator
            ->scalar('IVA')
            ->maxLength('IVA', 1)
            ->requirePresence('IVA', 'create')
            ->notEmptyString('IVA');

        $validator
            ->scalar('IMAGE')
            ->maxLength('IMAGE', 50)
            ->allowEmptyString('IMAGE');

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
