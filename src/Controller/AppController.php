<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth',[
            'authorize'=>['Controller'],
            'authenticate'=> [
                'Form'=>[
                    'fields'=>[
                        'username'=>'USERNAME',
                        'password'=>'PASSWORD'
                    ],
                    'userModel' => 'Users'
                ]
            ],
            'loginAction'=>[
                'controller'=>'users',
                'action'=>'login',
                'prefix' => 'admin'
            ],
            'authError'=> 'Acceso denegado',
            'loginRedirect'=>[
                'controller'=>'users',
                'action'=>'loginRedirect',
                'prefix' => 'admin'
            ],
            'unauthorizedRedirect'=>[
                'controller'=>'users',
                'action'=>'loginRedirect',
                'prefix' => 'admin'
            ]
        ]);            
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        
        $this->Auth->allow(['login', 'newPassword','resetPassword', 'books','home','contactUs','loginRedirect','add']);

        if ($this->request->params['controller'] == 'Pages') {
            $this->viewBuilder()->setLayout('front');
        } elseif ($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'login') {
            $this->viewBuilder()->setLayout('login');
        } else {
            $this->viewBuilder()->setLayout('default');
        }

        if ($this->Auth->user()) {
            $this->set('current_user', $this->Auth->user());
            $this->set('permitions', $this->getPermitions($this->Auth->user()['GROUP_ID']));
        } else {
            $this->set('current_user', ['name' => 'Invitado']);
            $this->set('permitions', $this->getPermitions(2));
        }
        // pr($this->Auth->user()['GROUP_ID']);die;

    }

    protected function getCurrentUser(){
        return $this->Auth->user();
    }

    public function getPermitions($roleId = null){
        $permitions = [
            'admin' => [
                'Products' => [
                    '*'
                ],
                'Recipes' => [
                    '*'
                ],
                'ProviderRequest' => [
                    '*'
                ],
                'SalesBox' => [
                    '*'
                ],
            ],
            'cellar' => [
                'Products' => [
                    '*'
                ],
                'Recipes' => [
                    '*'
                ],
                'ProviderRequest' => [
                    '*'
                ],
            ],
            'client' => [
                'SaleRequests' => [
                    'tracking',
                    'home',
                    'addSaleRequest',
                    'ajaxGetById'
                ]
            ],
            'reception' => [
                'Tables' => [
                    'assignTable'
                ]
            ],
            'finance' => [
                'SalesBox' => [
                    '*'
                ],
            ],
            'chefts' => [
                'SaleRequests' => [
                    'index'
                ]
            ]
        ];
        if(isset($roleId)){
            switch($roleId){
                case 0: //Administrador
                    return $permitions['admin'];
                case 1: //Bodega
                    return $permitions['cellar'];
                case 2: //Cliente
                    return $permitions['client'];
                case 3: //Recepcion
                    return $permitions['reception'];
                case 4: //Finanzas
                    return $permitions['finance'];
                case 5: //Cocineros
                    return $permitions['chefts'];
            }
        }

        return $permitions;
    }

    public function isAuthorized($user){
        return true;
        $params = $this->request->params;
        $publicFunction = [
            'login',
            'newPassword',
            'resetPassword',
            'books',
            'home',
            'contactUs',
            'loginRedirect'
        ];

        if(in_array($this->request->action, $publicFunction)){
            return true;
        }

        if(!empty($user['GROUP_ID'])){
            $permitions = $this->getPermitions($user['GROUP_ID']);
            if(!empty($permitions[$params['controller']])){
                if(in_array($this->request->action, $permitions[$params['controller']]) || in_array('*', $permitions[$params['controller']])){
                    return true;
                }
            }
        }
        return false;
    }
}
