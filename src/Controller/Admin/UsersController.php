<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Bills', 'ShoppingCarts']
        ]);

        $this->set('user', $user);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(('The {0} has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User'));
        }
        $this->set(compact('user'));
    }


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The {0} has been saved.', 'User'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User'));
        }
        $this->set(compact('user'));
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The {0} has been deleted.', 'User'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'User'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->Auth->user()) {
            $this->redirect(['action' => 'loginRedirect' ]);            
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Auth->identify();
            
            if ($user) {
                $this->Auth->setUser($user);
                switch($user['GROUP_ID']){
                    case 0: //Administrador
                        return $this->redirect(["controller" => 'Users', "action" => 'index']);
                    case 1: //Bodega
                        return $this->redirect(["controller" => 'Users', "action" => 'index']);
                    case 2: //Cliente
                        return $this->redirect(["controller" => 'SaleRequests', "action" => 'home']);
                    case 3:  //Recepcion
                        return $this->redirect(["controller" => 'Tables', "action" => 'assignTable']);
                    case 4:  //Finanzas
                        return $this->redirect(["controller" => 'Users', "action" => 'index']);
                    default:
                        return $this->redirect($this->Auth->redirectUrl());
                }
            }
        }

    }

    public function loginRedirect()
    {
        
        if ($this->Auth->user()) {
            switch($this->Auth->user()['role']){
                case 'sssds':
                    return $this->redirect('/pages/home');
                case 'ss':
                    return $this->redirect(['controller'=>'books', 'action'=>'index']);
                default:
                    return $this->redirect('/pages/home');

            }
        } else {
            return $this->redirect('/pages/home');
        }

    }

    public function logout() {
        $this->Auth->logout();
        $this->Flash->info("Hasta la proxima.");
        return $this->redirect(['action' => 'loginRedirect']);            
    }
}
