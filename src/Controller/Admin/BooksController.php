<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 *
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BooksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('books', $this->Books->find());
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => ['ShoppingCarts']
        ]);

        $this->set('book', $book);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $book = $this->Books->newEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            $book->stock = rand(0, 15);
            if ($this->Books->save($book)) {
                $this->Flash->success(__('Se ha guardado correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('No se ha podido guardar, intente mas tarde.');
        }
        $this->set(compact('book'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if (empty($data['book_dir']['tmp_name'])) {
                unset($data['book_dir']);
            }
            $book = $this->Books->patchEntity($book, $data);
            if ($this->Books->save($book)) {
                $this->Flash->success(__('Se ha guardado correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('No se ha podido guardar, intente mas tarde.');
        }
        $this->set(compact('book'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
                $this->Flash->success(__('Se ha eliminado correctamente'));
        } else {
            $this->Flash->error('No se ha podido eliminar, intente mas tarde.');
        }

        return $this->redirect(['action' => 'index']);
    }
}
