<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Date;
use \DateTime;
/**
 * SalesBox Controller
 *
 * @property \App\Model\Table\SalesBoxTable $SalesBox
 *
 * @method \App\Model\Entity\SalesBox[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalesBoxController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Reservations');
        $this->loadModel('SaleRequests');
        $this->loadComponent('Search.Prg', [
            'actions' => ['entries', 'expenses', 'dailyUtility', 'monthlyUtility']
        ]);
    }

    public function index()
    {
        $salesBox = $this->paginate($this->SalesBox);

        $this->set(compact('salesBox'));
    }

    public function entries()
    {
        $query = $this->SalesBox->find('search', [
            'search' => $this->request->query,
            'conditions' => [
                'ENTRY' => 1
            ],
        ]);
        $salesBox = $this->paginate($query);

        $this->set(compact('salesBox'));
    }

    public function addEntries()
    {
        $salesBox = $this->SalesBox->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesBox = $this->SalesBox->patchEntity($salesBox, $this->request->getData());
            $salesBox->ENTRY = 1;
            $salesBox->CREATED = $this->request->getData('CREATED');
            if ($this->SalesBox->save($salesBox)) {
                $this->Flash->success(__('El ingreso ha sido guardado exitosamente.'));

                return $this->redirect(['action' => 'entries']);
            }
            $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
        }
        $this->set(compact('salesBox'));
    }

    public function editEntries($id = null)
    {
        $salesBox = $this->SalesBox->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesBox = $this->SalesBox->patchEntity($salesBox, $this->request->getData());
            $salesBox->ENTRY = 1;
            $salesBox->CREATED = $this->request->getData('CREATED');
            if ($this->SalesBox->save($salesBox)) {
                $this->Flash->success(__('El ingreso ha sido guardado exitosamente.'));

                return $this->redirect(['action' => 'entries']);
            }
            $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
        }
        $this->set(compact('salesBox'));
    }

    public function deletedEntries($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $salesBox = $this->SalesBox->get($id);
        if ($this->SalesBox->delete($salesBox)) {
            $this->Flash->success(__('El ingreso ha sido eliminado exitosamente.'));
            return $this->redirect(['action' => 'entries']);
        }
        $this->Flash->error(__("Ha ocurrido un error."));
        return $this->redirect(['action' => 'entries']);
    }

    public function expenses()
    {
        $query = $this->SalesBox->find('search', [
            'search' => $this->request->query,
            'conditions' => [
                'ENTRY' => 0
            ],
        ]);
        $salesBox = $this->paginate($query);

        $this->set(compact('salesBox'));
    }
    
    public function addExpenses()
    {
        $salesBox = $this->SalesBox->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesBox = $this->SalesBox->patchEntity($salesBox, $this->request->getData());
            $salesBox->ENTRY = 0;
            $salesBox->CREATED = $this->request->getData('CREATED');
            if ($this->SalesBox->save($salesBox)) {
                $this->Flash->success(__('El egreso ha sido guardado exitosamente.'));

                return $this->redirect(['action' => 'expenses']);
            }
            $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
        }
        $this->set(compact('salesBox'));
    }

    public function editExpenses($id = null)
    {
        $salesBox = $this->SalesBox->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesBox = $this->SalesBox->patchEntity($salesBox, $this->request->getData());
            $salesBox->ENTRY = 0;
            $salesBox->CREATED = $this->request->getData('CREATED');
            if ($this->SalesBox->save($salesBox)) {
                $this->Flash->success(__('El ingreso ha sido guardado exitosamente.'));

                return $this->redirect(['action' => 'expenses']);
            }
            $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
        }
        $this->set(compact('salesBox'));
    }

    public function deletedExpenses($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $salesBox = $this->SalesBox->get($id);
        if ($this->SalesBox->delete($salesBox)) {
            $this->Flash->success(__('El egreso ha sido eliminado exitosamente.'));
            return $this->redirect(['action' => 'expenses']);
        }
        $this->Flash->error(__("Ha ocurrido un error."));
        return $this->redirect(['action' => 'expenses']);
    }

    public function dailyUtility()
    {
        $date = date('Y-m-d');
        $salesBox = $this->SalesBox->find('search',[
            'search' => $this->request->query
        ]);
        $dayeRequest = $this->request->getQuery('DATE');
        if(!isset($dayeRequest)){
            $salesBox->where(['CREATED' => $date]);
        }
        $utility = [];
        foreach($salesBox as $key => $sale){
            if($sale->ENTRY){
                $utility[date('Y-m-d', strtotime($sale->CREATED))]['ENTRY'][$key]['COMMENTARY'] = $sale->COMMENTARY;
                $utility[date('Y-m-d', strtotime($sale->CREATED))]['ENTRY'][$key]['TOTAL_PRICE'] = $sale->TOTAL_PRICE;
            } else {
                $utility[date('Y-m-d', strtotime($sale->CREATED))]['EXPENSY'][$key]['COMMENTARY'] = $sale->COMMENTARY;
                $utility[date('Y-m-d', strtotime($sale->CREATED))]['EXPENSY'][$key]['TOTAL_PRICE'] = $sale->TOTAL_PRICE;
            }
            if(isset($utility[date('Y-m-d', strtotime($sale->CREATED))]['TOTAL'])){
                if($sale->ENTRY){
                    $utility[date('Y-m-d', strtotime($sale->CREATED))]['TOTAL'] += $sale->TOTAL_PRICE;
                } else {
                    $utility[date('Y-m-d', strtotime($sale->CREATED))]['TOTAL'] -= $sale->TOTAL_PRICE;
                }
            } else {
                if($sale->ENTRY){
                    $utility[date('Y-m-d', strtotime($sale->CREATED))]['TOTAL'] = $sale->TOTAL_PRICE;
                } else {
                    $utility[date('Y-m-d', strtotime($sale->CREATED))]['TOTAL'] = -$sale->TOTAL_PRICE;
                }

            }
        }
        $this->set(compact('utility'));
    }
    
    public function monthlyUtility()
    {
        $m = date('m');
        $Y = date('Y');
        $salesBox = $this->SalesBox->find('search',[
            'search' => $this->request->query
        ]);
        $dayeRequest = $this->request->getQuery('DATEMONTH');
        $yearRequest = $this->request->getQuery('DATEYEAR');
        if(!isset($dayeRequest)){
            $salesBox->where(['extract (MONTH from CREATED) =' => $m]);
        }
        if(!isset($yearRequest)){
            $salesBox->where(['extract (YEAR from CREATED) =' => $Y]);
        }
        $utility = [];
        foreach($salesBox as $key => $sale){
            if($sale->ENTRY){
                $utility[date('Y-m', strtotime($sale->CREATED))]['ENTRY'][$key]['COMMENTARY'] = $sale->COMMENTARY;
                $utility[date('Y-m', strtotime($sale->CREATED))]['ENTRY'][$key]['TOTAL_PRICE'] = $sale->TOTAL_PRICE;
            } else {
                $utility[date('Y-m', strtotime($sale->CREATED))]['EXPENSY'][$key]['COMMENTARY'] = $sale->COMMENTARY;
                $utility[date('Y-m', strtotime($sale->CREATED))]['EXPENSY'][$key]['TOTAL_PRICE'] = $sale->TOTAL_PRICE;
            }
            if(isset($utility[date('Y-m', strtotime($sale->CREATED))]['TOTAL'])){
                if($sale->ENTRY){
                    $utility[date('Y-m', strtotime($sale->CREATED))]['TOTAL'] += $sale->TOTAL_PRICE;
                } else {
                    $utility[date('Y-m', strtotime($sale->CREATED))]['TOTAL'] -= $sale->TOTAL_PRICE;
                }
            } else {
                if($sale->ENTRY){
                    $utility[date('Y-m', strtotime($sale->CREATED))]['TOTAL'] = $sale->TOTAL_PRICE;
                } else {
                    $utility[date('Y-m', strtotime($sale->CREATED))]['TOTAL'] = -$sale->TOTAL_PRICE;
                }

            }
        }
        $this->set(compact('utility'));
    }

    public function accountsPayment()
    {
        $query = $this->Reservations->find('all', [
            'conditions' => [
                'STATUS_ID IN' => [2, 3]
            ],
            'contain' => [
                'Tables'
            ]
        ]);
        $reservations = [];
        foreach($query as $key => $data){
            $saleRequests = $this->SaleRequests->find('all', [
                'conditions' => [
                    'RESER_ID' => $data->ID,
                    'STATUS_ID' => 4
                ],
                'contain' => [
                    'Recipes'
                ]
            ]);
            $reservations[$key]['ID'] = $data->ID;
            $reservations[$key]['TABLE'] = $data->table->NAME;
            $total = 0;
            foreach ($saleRequests as $saleRequest){
                if($saleRequest->recipe->IVA){
                    $subTotalSale = $saleRequest->QUANTITY * $saleRequest->recipe->PRICE;
                } else {
                    $subTotalSale = $saleRequest->QUANTITY * ($saleRequest->recipe->PRICE*1.19);
                }
                if($saleRequest->recipe->IVA){
                    $total += $subTotalSale;
                } else {
                    $total += $subTotalSale+($saleRequest->recipe->PRICE * 0.19);
                }
            }
            $reservations[$key]['TOTAL'] = $total;
            $reservations[$key]['TYPE'] = $data->STATUS_ID;
        }
        $this->set(compact('reservations'));

    }

    public function payAccount($id = null, $total = null)
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservation = $this->Reservations->get($id);

            if($reservation->STATUS_ID == 2){
                $reservation->STATUS_ID = 5;
            } else {
                $reservation->STATUS_ID = 4;
            }
            if($this->Reservations->save($reservation)){
                $salesBox = $this->SalesBox->newEntity();
                $salesBox->RESERVATION_ID = $id;
                $salesBox->ENTRY = 1;
                $salesBox->CREATED = date('d-m-Y');
                $salesBox->TOTAL_PRICE = $total;
                $salesBox->COMMENTARY = "Venta general";
                if ($this->SalesBox->save($salesBox)) {
                    $this->Flash->success(__('La venta se cobro exitosamente!.'));
                } else {
                    $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
                }
            } else {
                $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
            }
        }
        return $this->redirect(['action' => 'accountsPayment']);
    }
    /**
     * View method
     *
     * @param string|null $id Sales Box id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesBox = $this->SalesBox->get($id, [
            'contain' => [],
        ]);

        $this->set('salesBox', $salesBox);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesBox = $this->SalesBox->newEntity();
        if ($this->request->is('post')) {
            $salesBox = $this->SalesBox->patchEntity($salesBox, $this->request->getData());
            if ($this->SalesBox->save($salesBox)) {
                $this->Flash->success(__('The sales box has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales box could not be saved. Please, try again.'));
        }
        $this->set(compact('salesBox'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Box id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesBox = $this->SalesBox->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesBox = $this->SalesBox->patchEntity($salesBox, $this->request->getData());
            if ($this->SalesBox->save($salesBox)) {
                $this->Flash->success(__('The sales box has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales box could not be saved. Please, try again.'));
        }
        $this->set(compact('salesBox'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Box id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesBox = $this->SalesBox->get($id);
        if ($this->SalesBox->delete($salesBox)) {
            $this->Flash->success(__('The sales box has been deleted.'));
        } else {
            $this->Flash->error(__('The sales box could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
