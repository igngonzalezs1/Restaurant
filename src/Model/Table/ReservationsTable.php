<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reservations Model
 *
 * @method \App\Model\Entity\Reservation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reservation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reservation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reservation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reservation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reservation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reservation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reservation findOrCreate($search, callable $callback = null, $options = [])
 */
class ReservationsTable extends Table
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

        $this->setTable('reservations');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');

        $this->belongsTo('ReservationStatus',[
            'foreignKey' => 'STATUS_ID'
        ]);
        $this->belongsTo('Tables',[
            'foreignKey' => 'TABLE_ID'
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
            ->dateTime('CREATED')
            ->requirePresence('CREATED', 'create')
            ->notEmptyDateTime('CREATED');

        $validator
            ->dateTime('MODIFICATE')
            ->requirePresence('MODIFICATE', 'create')
            ->notEmptyDateTime('MODIFICATE');

        $validator
            ->integer('USER_ID')
            ->requirePresence('USER_ID', 'create')
            ->notEmptyString('USER_ID');

        $validator
            ->integer('TABLE_ID')
            ->requirePresence('TABLE_ID', 'create')
            ->notEmptyString('TABLE_ID');

        $validator
            ->integer('STATUS_ID')
            ->requirePresence('STATUS_ID', 'create')
            ->notEmptyString('STATUS_ID');

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
