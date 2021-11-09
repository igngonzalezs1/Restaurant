<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * BillStates Controller
 *
 * @property \App\Model\Table\BillStatesTable $BillStates
 *
 * @method \App\Model\Entity\BillState[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BillStatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $billStates = $this->paginate($this->BillStates);

        $this->set(compact('billStates'));
    }

    /**
     * View method
     *
     * @param string|null $id Bill State id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $billState = $this->BillStates->get($id, [
            'contain' => ['Bills']
        ]);

        $this->set('billState', $billState);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $billState = $this->BillStates->newEntity();
        if ($this->request->is('post')) {
            $billState = $this->BillStates->patchEntity($billState, $this->request->getData());
            if ($this->BillStates->save($billState)) {
                $this->Flash->success(__('The {0} has been saved.', 'Bill State'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bill State'));
        }
        $this->set(compact('billState'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bill State id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $billState = $this->BillStates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $billState = $this->BillStates->patchEntity($billState, $this->request->getData());
            if ($this->BillStates->save($billState)) {
                $this->Flash->success(__('The {0} has been saved.', 'Bill State'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bill State'));
        }
        $this->set(compact('billState'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bill State id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $billState = $this->BillStates->get($id);
        if ($this->BillStates->delete($billState)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Bill State'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Bill State'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
