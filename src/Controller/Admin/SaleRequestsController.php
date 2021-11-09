<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Entity\ReservationStatus;
use App\Model\Entity\SaleRequestStatus;
use Cake\I18n\Date;
use \DateTime;
/**
 * SaleRequests Controller
 *
 *
 * @method \App\Model\Entity\SaleRequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SaleRequestsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function initialize()
    {
        parent::initialize();
        $this->_currentDateTime = new DateTime();
        $this->loadComponent('Search.Prg', [
            'actions' => ['home']
        ]);
        $this->loadModel('Recipes');
    }

    public function home()
    {
        $recipes = $this->Recipes->find('search',[
            'search' => $this->request->query
        ]);
        $this->viewBuilder()->setLayout('normal');
        $this->set(compact('recipes'));
    }

    public function tracking()
    {
        $user = $this->getCurrentUser();
        $this->viewBuilder()->setLayout('normal');
        $reservation = $this->SaleRequests->Reservations->find('all', [
            'conditions' => [
                'USER_ID' => $user['ID'],
                'STATUS_ID' => ReservationStatus::OPEN
            ]
        ])->last();
        $saleRequests = $this->SaleRequests->find('all', [
            'conditions' => [
                'RESER_ID' => $reservation->ID
            ],
            'contain' => [
                'Recipes'
            ]
        ]);

        $saleRequestStatus = $this->SaleRequests->saleRequestStatus->find('all');

        $this->set(compact('saleRequests', 'saleRequestStatus'));
    }

    public function cashPay($id = null)
    {
        $reservation = $this->SaleRequests->Reservations->get($id);
        $reservation->STATUS_ID = 2;
        if($this->SaleRequests->Reservations->save($reservation)){
            $this->Flash->success('Se ha solicitado la solicitud de pago por caja, por favor espere!');
            $this->Auth->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        } else {
            $this->Flash->error(__("Ha ocurrido un error."));
        }
        return $this->redirect(['action' => 'home']);

    }

    public function creditPay($id = null)
    {
        $reservation = $this->SaleRequests->Reservations->get($id);
        $reservation->STATUS_ID = 3;
        if($this->SaleRequests->Reservations->save($reservation)){
            $this->Flash->success('Se ha solicitado la solicitud de pago por debito/credito, por favor espere!');
            $this->Auth->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        } else {
            $this->Flash->error(__("Ha ocurrido un error."));
        }
        return $this->redirect(['action' => 'home']);

    }

    public function addSaleRequest()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $user = $this->getCurrentUser();
            $reservation = $this->SaleRequests->Reservations->find('all',[
                'conditions' => [
                    'USER_ID' => $user['ID'],
                    'STATUS_ID' => ReservationStatus::OPEN
                ]
            ])->last();
            if(isset($reservation->ID)){
                $saleRequest = $this->SaleRequests->newEntity($data);
                $saleRequest->PRICE_TOTAL = $data['QUANTITY']*$data['RECIPE_PRICE'];
                $saleRequest->RESER_ID = $reservation->ID;
                $saleRequest->STATUS_ID = SaleRequestStatus::EP;
                $saleRequest->CREATED = date("Y-m-d H:i:s");
                $saleRequest->MODIFICATE = date("Y-m-d H:i:s");
                if($this->SaleRequests->save($saleRequest)){
                    $this->Flash->success('El pedido ha sido ingresado con exito!');
    
                } else {
                    $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
                }
            } else {
                $this->Flash->error(__("Ha ocurrido un error con la reserva."));
            }
        }
        return $this->redirect(['action' => 'home']);
    }

    public function ajaxGetById()
    {
        $this->viewBuilder()->autoLayout(false);
        $this->viewClass = 'Ajax.Ajax';
        $recipe = $this->Recipes->get($this->request->getQuery('id'));
        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'recipe' => $recipe
            ]));
    }

    public function index()
    {
        $saleRequests = $this->SaleRequests->find('all',[
            'conditions' => [
                'SaleRequests.STATUS_ID NOT IN' => [SaleRequestStatus::CL, SaleRequestStatus::ET]
            ],
            'contain' => [
                'Recipes',
                'saleRequestStatus',
                'Reservations' => [
                    'Tables'
                ]
            ]
        ]);
        $this->viewBuilder()->setLayout('normal');

        $this->set(compact('saleRequests'));
    }

    public function reloadStatus($id = null)
    {
        $saleRequest = $this->SaleRequests->get($id);
        if( $this->SaleRequests->saleRequestStatus->exists(['ID' => $saleRequest->STATUS_ID+1])){
            $saleRequest->STATUS_ID = $saleRequest->STATUS_ID+1;
            if ($this->SaleRequests->save($saleRequest)) {
                $this->Flash->success('Se Actualizo el registro con exito!.');
            } else {
                $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
            }
        } else {
            $this->Flash->error(__("Ha ocurrido un error."));

        }
        return $this->redirect(['action' => 'index']);
    }

    public function cancelSaleRequest()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $saleRequest = $this->SaleRequests->get($data['ID']);
            $saleRequest->CANCELATIONS = $data['CANCELATIONS'];
            $saleRequest->STATUS_ID = SaleRequestStatus::CL;
            if ($this->SaleRequests->save($saleRequest)) {
                $this->Flash->success('Se Cancelo el registro con exito!.');
            } else {
                $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
            }       
        }
        return $this->redirect(['action' => 'index']);

    }

    public function saleAccount()
    {
        $user = $this->getCurrentUser();
        $this->viewBuilder()->setLayout('normal');
        $reservation = $this->SaleRequests->Reservations->find('all', [
            'conditions' => [
                'USER_ID' => $user['ID'],
                'STATUS_ID' => ReservationStatus::OPEN
            ]
        ])->last();
        $saleRequests = [];
        if(isset($reservation->ID)){
            $saleRequests = $this->SaleRequests->find('all', [
                'conditions' => [
                    'RESER_ID' => $reservation->ID,
                    'STATUS_ID IN' => [SaleRequestStatus::ET]
                ],
                'contain' => [
                    'Recipes'
                ]
            ]);
        }


        $this->set(compact('saleRequests'));
    }

    /**
     * View method
     *
     * @param string|null $id Sale Request id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $saleRequest = $this->SaleRequests->get($id, [
            'contain' => [],
        ]);

        $this->set('saleRequest', $saleRequest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $saleRequest = $this->SaleRequests->newEntity();
        if ($this->request->is('post')) {
            $saleRequest = $this->SaleRequests->patchEntity($saleRequest, $this->request->getData());
            if ($this->SaleRequests->save($saleRequest)) {
                $this->Flash->success(__('The sale request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale request could not be saved. Please, try again.'));
        }
        $this->set(compact('saleRequest'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sale Request id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $saleRequest = $this->SaleRequests->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $saleRequest = $this->SaleRequests->patchEntity($saleRequest, $this->request->getData());
            if ($this->SaleRequests->save($saleRequest)) {
                $this->Flash->success(__('The sale request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale request could not be saved. Please, try again.'));
        }
        $this->set(compact('saleRequest'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sale Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $saleRequest = $this->SaleRequests->get($id);
        if ($this->SaleRequests->delete($saleRequest)) {
            $this->Flash->success(__('The sale request has been deleted.'));
        } else {
            $this->Flash->error(__('The sale request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
