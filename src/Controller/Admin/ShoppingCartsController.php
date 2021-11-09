<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * ShoppingCarts Controller
 *
 * @property \App\Model\Table\ShoppingCartsTable $ShoppingCarts
 *
 * @method \App\Model\Entity\ShoppingCart[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ShoppingCartsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Books', 'Bills', 'Users']
        ];
        $shoppingCarts = $this->paginate($this->ShoppingCarts);

        $this->set(compact('shoppingCarts'));
    }

    /**
     * View method
     *
     * @param string|null $id Shopping Cart id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shoppingCart = $this->ShoppingCarts->get($id, [
            'contain' => ['Books', 'Bills', 'Users']
        ]);

        $this->set('shoppingCart', $shoppingCart);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shoppingCart = $this->ShoppingCarts->newEntity();
        if ($this->request->is('post')) {
            $shoppingCart = $this->ShoppingCarts->patchEntity($shoppingCart, $this->request->getData());
            if ($this->ShoppingCarts->save($shoppingCart)) {
                $this->Flash->success(__('The {0} has been saved.', 'Shopping Cart'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Shopping Cart'));
        }
        $books = $this->ShoppingCarts->Books->find('list', ['limit' => 200]);
        $bills = $this->ShoppingCarts->Bills->find('list', ['limit' => 200]);
        $users = $this->ShoppingCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('shoppingCart', 'books', 'bills', 'users'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Shopping Cart id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $shoppingCart = $this->ShoppingCarts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shoppingCart = $this->ShoppingCarts->patchEntity($shoppingCart, $this->request->getData());
            if ($this->ShoppingCarts->save($shoppingCart)) {
                $this->Flash->success(__('The {0} has been saved.', 'Shopping Cart'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Shopping Cart'));
        }
        $books = $this->ShoppingCarts->Books->find('list', ['limit' => 200]);
        $bills = $this->ShoppingCarts->Bills->find('list', ['limit' => 200]);
        $users = $this->ShoppingCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('shoppingCart', 'books', 'bills', 'users'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Shopping Cart id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shoppingCart = $this->ShoppingCarts->get($id);
        if ($this->ShoppingCarts->delete($shoppingCart)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Shopping Cart'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Shopping Cart'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
