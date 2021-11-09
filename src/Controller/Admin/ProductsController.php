<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('ProviderProducts');
        $this->loadComponent('Search.Prg', [
            'actions' => ['index', 'providerProducts']
        ]);
    }

    public function index()
    {
        $query = $this->Products->find('search',[
            'search' => $this->request->query,
            'conditions' => [
                'DELETED' => 0
            ]
        ]);
        $products = $this->paginate($query);

        $this->set(compact('products'));
    }

    public function providerProducts()
    {
        $query = $this->ProviderProducts->find('search',[
            'search' => $this->request->query,
            'contain' => [
                'Products',
                'Providers',
                'UnitsOfWeights'
            ]
        ]);
        $providerProducts = $this->paginate($query);

        $this->set(compact('providerProducts'));   
    }

    public function editProviderProduct($id = null)
    {
        $providerProduct = $this->ProviderProducts->find('all',[
            'conditions' => [
                'ProviderProducts.ID' => $id
            ]
        ])->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $providerProduct = $this->ProviderProducts->patchEntity($providerProduct, $this->request->getData());
            if($this->ProviderProducts->save($providerProduct)){
                $this->Flash->success(__("El producto ha sido modificado exitosamente."));
                return $this->redirect(['action' => 'providerProducts']);
            } else {
                $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
            }
        }

        $products = $this->Products->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ],
        [
            'conditions' => [
                'DELETED' => 0
            ]
        ]);
        $unitsOfWeights = $this->ProviderProducts->UnitsOfWeights->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ]);

        $providers = $this->ProviderProducts->Providers->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ]); 

        $this->set(compact('providerProduct', 'products', 'unitsOfWeights','providers'));   
    }

    public function deleteProviderProduct($id = null)
    {
        $providerProduct = $this->ProviderProducts->find('all',[
            'conditions' => [
                'ProviderProducts.ID' => $id
            ]
        ])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            if($this->ProviderProducts->delete($providerProduct)){
                $this->Flash->success(__("El producto ha sido eliminado exitosamente."));
            } else {
                $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
            }
        }
        return $this->redirect(['action' => 'providerProducts']);
    }

    public function cancelProviderProduct($id = null)
    {
        $providerProduct = $this->ProviderProducts->find('all',[
            'conditions' => [
                'ProviderProducts.ID' => $id
            ]
        ])->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            if($providerProduct->ACTIVE){
                $providerProduct->ACTIVE = 0;
            } else {
                $providerProduct->ACTIVE = 1;
            }
            if($this->ProviderProducts->save($providerProduct)){
                $this->Flash->success(__("El producto ha sido activado exitosamente."));
            } else {
                $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
            }
        }
        return $this->redirect(['action' => 'providerProducts']);
    }

    public function addProviderProduct()
    {
        $providerProduct = $this->ProviderProducts->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $providerProduct = $this->ProviderProducts->patchEntity($providerProduct, $this->request->getData());
            $id = $this->ProviderProducts->find('all',[
                'order' => ['ID'=>'asc']
            ])->last();
            $providerProduct->ACTIVE = 1;
            $providerProduct->ID = $id->ID+1;
            if($this->ProviderProducts->save($providerProduct)){
                $this->Flash->success(__("El producto ha sido guardado exitosamente."));
                return $this->redirect(['action' => 'providerProducts']);
            } else {
                $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
            }
        }

        $products = $this->Products->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ],
        [
            'conditions' => [
                'DELETED' => 0
            ]
        ]);
        $unitsOfWeights = $this->ProviderProducts->UnitsOfWeights->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ]);

        $providers = $this->ProviderProducts->Providers->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ]); 

        $this->set(compact('providerProduct', 'products', 'unitsOfWeights','providers'));   
    }
    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->DELETED = 0;
            if ($this->Products->save($product)) {
                $this->Flash->success(__('El producto ha sido guardado con exito.'));
            } else {
                $this->Flash->error(__("Ha ocurrido un error, por favor intente más tarde."));
            }
        }
        return $this->redirect(['action' => 'index']);

    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $product = $this->Products->get($data['ID']);
            $product = $this->Products->patchEntity($product, $data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('El producto fue editado correctamente.'));
            } else {
                $this->Flash->error(__("Ha ocurrido un error, por favor intente más tarde."));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function cancel($id = null)
    {

        $product = $this->Products->get($id);
        $product->DELETED = 1;
        if ($this->Products->save($product)) {
            $this->Flash->success(__('El producto fue eliminado correctamente.'));
        } else {
            $this->Flash->error(__("Ha ocurrido un error, por favor intente más tarde."));
        }   
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
