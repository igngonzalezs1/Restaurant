<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Entity\TableStatus;
use App\Model\Entity\Group;
use App\Model\Entity\ReservationStatus;
use Cake\I18n\Date;
use \DateTime;
/**
 * Tables Controller
 *
 * @property \App\Model\Table\TablesTable $Tables
 *
 * @method \App\Model\Entity\Table[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TablesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Users');
        $this->loadModel('Reservations');
        $this->loadComponent('Search.Prg', [
            'actions' => ['assignedUserTable']
        ]);
        $this->_currentDateTime = new DateTime();
    }

    public function index()
    {
        $tables = $this->Tables->find('all');
        $tables = $this->paginate($this->Tables);
        
        $this->set(compact('tables'));
    }

    /**
     * View method
     *
     * @param string|null $id Table id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $table = $this->Tables->get($id, [
            'contain' => [],
        ]);

        $this->set('table', $table);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $table = $this->Tables->newEntity();
        if ($this->request->is('post')) {
            $table = $this->Tables->patchEntity($table, $this->request->getData());
            if ($this->Tables->save($table)) {
                $this->Flash->success(__('The table has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The table could not be saved. Please, try again.'));
        }
        $this->set(compact('table'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Table id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $table = $this->Tables->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $table = $this->Tables->patchEntity($table, $this->request->getData());
            if ($this->Tables->save($table)) {
                $this->Flash->success(__('The table has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The table could not be saved. Please, try again.'));
        }
        $this->set(compact('table'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Table id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $table = $this->Tables->get($id);
        if ($this->Tables->delete($table)) {
            $this->Flash->success(__('The table has been deleted.'));
        } else {
            $this->Flash->error(__('The table could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function assignTable(){
        $tables = $this->Tables->find('all',[
            'contain' => 'TableStatus'
        ]);
        $this->set(compact('tables'));
    }

    public function cancel($id = null)
    {
        $reservations = $this->Reservations->find('all',[
            'conditions' => [
                'TABLE_ID' => $id,
                'STATUS_ID' => ReservationStatus::OPEN
            ]
        ]);

        foreach ($reservations as $reservation) {
            $reservation->STATUS_ID = ReservationStatus::CLOSE;
           $this->Reservations->save($reservation);
        }

        $table = $this->Tables->get($id);
        $table->TABLE_STATUS_ID = TableStatus::AVAILABLE;
        if($this->Tables->save($table)){
            $this->Flash->success(__("La reserva a sido cancelada."));
        } else {
            $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
        }
        return $this->redirect($this->request->referer());
    }

    public function addUserTable($tableId = null)
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->newEntity($this->request->getData());
            $user->PASSWORD = substr($this->request->getData('RUT'), 0, 2);
            $names = explode(" ", $user->NAME);

            $userName = null;
            foreach($names as $key => $name){
                if($key == 0){
                    $userName = substr($name, 0, 4);
                }
                if($key == 1){
                    $userName = $userName.'.'.substr($name, 0, 4);
                }
            }
            $userName = $userName.'.'.substr($this->request->getData('RUT'), 0, 2);

            $user->USERNAME = $userName;
            $user->GROUP_ID = Group::CLIENT;

            if($this->Users->Save($user)){
                $data['USER_ID'] = $user->ID;
                $data['CREATED'] = new DateTime();
                $data['MODIFICATE'] = new DateTime();
                $data['STATUS_ID'] = ReservationStatus::OPEN;
                $data['TABLE_ID'] = $tableId;

                $table = $this->Tables->get($data['TABLE_ID']);
                $reservation = $this->Reservations->newEntity($data);
    
                if($this->Reservations->save($reservation)){
                    $table->TABLE_STATUS_ID = TableStatus::OCUPIED;
                    $this->Tables->save($table);
                    $this->Flash->success(__("La reserva a sido agregada correctamente."));
                    return $this->redirect(['action' => 'assignTable']);
                } else {
                    $this->Flash->error(__("Ha ocurrido un error, por favor intente más tarde."));
                }
            }
        }
    }

    public function assignedUserTable($tableId = null)
    {
        $users = $this->Users->find('search',[
            'search' => $this->request->query,
            'conditions' => [
                'GROUP_ID' => Group::CLIENT
            ]
        ])->toArray();

        foreach($users as $key => $user){
            $reservation = $this->Reservations->find('all',[
                'fields' => [
                    'USER_ID', 
                    'STATUS_ID'
                ],
                'conditions' => [
                    'USER_ID' => $user->ID,
                    'STATUS_ID' => ReservationStatus::OPEN
                ]
            ]);

            if(!empty($reservation->toArray())){
                unset($users[$key]);
            }
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['CREATED'] = new DateTime();
            $data['MODIFICATE'] = new DateTime();
            $data['STATUS_ID'] = ReservationStatus::OPEN;

            $table = $this->Tables->get($data['TABLE_ID']);
            $reservation = $this->Reservations->newEntity($data);

            if($this->Reservations->save($reservation)){
                $table->TABLE_STATUS_ID = TableStatus::OCUPIED;
                $this->Tables->save($table);
                $this->Flash->success(__("La reserva a sido agregada correctamente."));
                return $this->redirect(['action' => 'assignTable']);
            } else {
                $this->Flash->error(__("Ha ocurrido un error, por favor intente más tarde."));
            }
        }
        $this->set(compact('users', 'tableId'));
    }

}
