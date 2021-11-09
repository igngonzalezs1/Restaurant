<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Bills Controller
 *
 * @property \App\Model\Table\BillsTable $Bills
 *
 * @method \App\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BillsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'BillStates']
        ];
        $bills = $this->paginate($this->Bills);

        $this->set(compact('bills'));
    }

    /**
     * View method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bill = $this->Bills->get($id, [
            'contain' => ['Users', 'BillStates', 'ShoppingCarts']
        ]);

        $this->set('bill', $bill);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bill = $this->Bills->newEntity();
        if ($this->request->is('post')) {
            $bill = $this->Bills->patchEntity($bill, $this->request->getData());
            if ($this->Bills->save($bill)) {
                $this->Flash->success(__('The {0} has been saved.', 'Bill'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bill'));
        }
        $users = $this->Bills->Users->find('list', ['limit' => 200]);
        $billStates = $this->Bills->BillStates->find('list', ['limit' => 200]);
        $this->set(compact('bill', 'users', 'billStates'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bill = $this->Bills->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bill = $this->Bills->patchEntity($bill, $this->request->getData());
            if ($this->Bills->save($bill)) {
                $this->Flash->success(__('The {0} has been saved.', 'Bill'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bill'));
        }
        $users = $this->Bills->Users->find('list', ['limit' => 200]);
        $billStates = $this->Bills->BillStates->find('list', ['limit' => 200]);
        $this->set(compact('bill', 'users', 'billStates'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bill id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bill = $this->Bills->get($id);
        if ($this->Bills->delete($bill)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Bill'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Bill'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
