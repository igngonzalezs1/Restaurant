<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('ID');
        
        $this->hasMany('SaleRequests',[
            'foreignKey' => 'USER_ID'
        ]);
        $this->addBehavior('Search.Search');
        $this->searchManager()
        ->add('NAME', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['NAME LIKE' => '%'.$args['NAME'].'%']);
            }
        ])
        ->add('RUT', 'Search.Callback',[
            'callback' => function($query, $args, $filter){
                return $query->where(['RUT LIKE' => '%'.$args['RUT'].'%']);
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
            ->scalar('USERNAME')
            ->maxLength('USERNAME', 255)
            ->requirePresence('USERNAME', 'create')
            ->notEmptyString('USERNAME');

        $validator
            ->scalar('PASSWORD')
            ->maxLength('PASSWORD', 255)
            ->requirePresence('PASSWORD', 'create')
            ->notEmptyString('PASSWORD');

        $validator
            ->scalar('NAME')
            ->maxLength('NAME', 255)
            ->requirePresence('NAME', 'create')
            ->notEmptyString('NAME');

        $validator
            ->scalar('RUT')
            ->maxLength('RUT', 255)
            ->requirePresence('RUT', 'create')
            ->notEmptyString('RUT');

        $validator
            ->scalar('EMAIL')
            ->maxLength('EMAIL', 255)
            ->requirePresence('EMAIL', 'create')
            ->notEmptyString('EMAIL');

        $validator
            ->integer('GROUP_ID')
            ->requirePresence('GROUP_ID', 'create')
            ->notEmptyString('GROUP_ID');

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
