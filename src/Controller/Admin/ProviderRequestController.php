<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * ProviderRequest Controller
 *
 * @property \App\Model\Table\ProviderRequestTable $ProviderRequest
 *
 * @method \App\Model\Entity\ProviderRequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProviderRequestController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('ProRequestProd');
        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);

    }

    public function index()
    {
        $query = $this->ProviderRequest->find('search', [
            'search' => $this->request->query,
            'contain' => [
                'ProRequestProd' => [
                    'Products',
                    'UnitsOfWeights'
                ],
                'Providers',
                'RequestProdStatus'
            ]
        ]);
        $providerRequests = $this->paginate($query);

        $this->set(compact('providerRequests'));
    }

    public function toAccept($id = null)
    {
        $user = $this->getCurrentUser();
        if($user['GROUP_ID'] == 0){
            if ($this->request->is(['patch', 'post', 'put'])) {
                $providerRequest = $this->ProviderRequest->get($id);
                $providerRequest->STATUS_ID = 1;
                if ($this->ProviderRequest->save($providerRequest)) {
                    $this->Flash->success(__('El pedido a sido aceptado de forma correcta.'));
                } else {
                    $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
                }
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function toRefuse($id = null)
    {
        $user = $this->getCurrentUser();
        if($user['GROUP_ID'] == 0){
            if ($this->request->is(['patch', 'post', 'put'])) {
                $providerRequest = $this->ProviderRequest->get($id);
                $providerRequest->STATUS_ID = 2;
                if ($this->ProviderRequest->save($providerRequest)) {
                    $this->Flash->success(__('El pedido a sido rechazado de forma correcta.'));
                } else {
                    $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
                }
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function ajaxDeleteProductById()
    {
        $this->viewBuilder()->autoLayout(false);
        $this->viewClass = 'Ajax.Ajax';
        $id = $this->request->getData('id');
        $proRequestProd = $this->ProRequestProd->get($id);
        if($this->ProRequestProd->delete($proRequestProd)){
            return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'true' => true,
            ]));;
        }
        return null;
    }

    /**
     * View method
     *
     * @param string|null $id Provider Request id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $providerRequest = $this->ProviderRequest->get($id, [
            'contain' => [],
        ]);

        $this->set('providerRequest', $providerRequest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $providerRequest = $this->ProviderRequest->newEntity();
        if ($this->request->is('post')) {
            $providerRequest = $this->ProviderRequest->patchEntity($providerRequest, $this->request->getData());
            $providerRequest->STATUS_ID = 0;
            if ($this->ProviderRequest->save($providerRequest)) {
                $proRequestProd = $this->ProRequestProd->newEntities($this->request->getData('pro_request_prod'));
                foreach($proRequestProd as $key => $prod){
                    $proRequestProd[$key]->PRO_REQ_ID =  $providerRequest->ID;
                }
                $this->ProRequestProd->saveMany($proRequestProd);
                $this->Flash->success(__('El pedido a sido ingresado de forma correcta.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
        }
        $providers = $this->ProviderRequest->Providers->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ]);
        $products = $this->ProRequestProd->Products->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ],
        [
            'conditions' => [
                'DELETED' => 0
            ]
        ]);
        $unitsOfWeights = $this->ProRequestProd->UnitsOfWeights->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ]);
        $this->set(compact('providerRequest', 'providers', 'products', 'unitsOfWeights'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Provider Request id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $providerRequest = $this->ProviderRequest->get($id, [
            'contain' => [],
            'condition' => [
                // 'STATUS_ID' => 0
            ]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $providerRequest = $this->ProviderRequest->patchEntity($providerRequest, $this->request->getData());
            if ($this->ProviderRequest->save($providerRequest)) {
                $requestProd = $this->request->getData('pro_request_prod');
                foreach($requestProd as $key => $prod){
                    if(!isset($prod['ID'])){
                        $proRequestProd = $this->ProRequestProd->newEntity($prod);
                    } else {
                        $proRequestProd = $this->ProRequestProd->get($prod['ID']);
                        $proRequestProd = $this->ProRequestProd->patchEntity($proRequestProd, $prod);
                    }
                    $proRequestProd->PRO_REQ_ID =  $providerRequest->ID;
                    $this->ProRequestProd->save($proRequestProd);
                }
                $this->Flash->success(__('El pedido a sido ingresado de forma correcta.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
        }
        $porRequestProd = $this->ProRequestProd->find('all', [
            'conditions' => [
                'PRO_REQ_ID' => $id
            ]
        ]);
        $providers = $this->ProviderRequest->Providers->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ]);
        $products = $this->ProRequestProd->Products->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ],
        [
            'conditions' => [
                'DELETED' => 0
            ]
        ]);
        $unitsOfWeights = $this->ProRequestProd->UnitsOfWeights->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ]);
        $this->set(compact('providerRequest', 'providers', 'products', 'unitsOfWeights', 'porRequestProd'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Provider Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $providerRequest = $this->ProviderRequest->get($id, [
            'contain' => [
                'ProRequestProd'
            ]
        ]);
        if ($this->ProviderRequest->delete($providerRequest)) {
            $this->Flash->success(__('El pedido ha sido eliminado correctamente.'));
        } else {
            $this->Flash->error(__('Ha ocurrido un error al momento de eliminar.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
