<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Recipes Controller
 *
 * @property \App\Model\Table\RecipesTable $Recipes
 *
 * @method \App\Model\Entity\Recipe[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RecipesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('RecipeProducts');
        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);

    }

    public function index()
    {
        $query = $this->Recipes->find('search',[
            'search' => $this->request->query,
            'order' => [
                'ID' => 'ASC'
            ]
        ]);
        $recipes = $this->paginate($query);

        $this->set(compact('recipes'));
    }

    public function ajaxDeleteProductById()
    {
        $this->viewBuilder()->autoLayout(false);
        $this->viewClass = 'Ajax.Ajax';
        $id = $this->request->getData('id');
        $recipeProduct = $this->RecipeProducts->get($id);
        if($this->RecipeProducts->delete($recipeProduct)){
            return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'true' => true,
            ]));;
        }
        return null;
    }

    public function ajaxGetById()
    {
        $this->viewBuilder()->autoLayout(false);
        $this->viewClass = 'Ajax.Ajax';
        $id = $this->request->getQuery('id');
        $recipe = $this->Recipes->get($id);
        $queryRecipeProducts = $this->RecipeProducts->find('all',[
            'conditions' => [
                'RECIPE_ID' => $id
            ],
            'contain' => [
                'Products',
                'UnitsOfWeights'
            ]
        ]);
        $recipeProducts = [];
        foreach($queryRecipeProducts as $key => $queryRecipeProduct){
            $recipeProducts[$key]['QUANTITE'] = $queryRecipeProduct->QUANTITE;
            $recipeProducts[$key]['UNITS'] = $queryRecipeProduct->units_of_weight->NAME;
            $recipeProducts[$key]['PRODUCT'] = $queryRecipeProduct->product->NAME;
        }
        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'recipe' => $recipe,
                'recipeProducts' => $recipeProducts
            ]));
    }

    /**
     * View method
     *
     * @param string|null $id Recipe id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $recipe = $this->Recipes->get($id, [
            'contain' => [],
        ]);

        $this->set('recipe', $recipe);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $recipe = $this->Recipes->newEntity();
        if ($this->request->is('post')) {
            if (!empty($this->request->data['upload']['name'])) {
                $file = $this->request->data['upload']; //put the data into a var for easy use
                $dir = WWW_ROOT . 'img' .DS. 'recipes';

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);
                
                //only process if the extension is valid
                if (in_array($ext, $arr_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'],$dir.DS. $setNewFileName . '.' . $ext);
                
                    //prepare the filename for database entry 
                    $imageFileName = $setNewFileName . '.' . $ext;
                }
            }
            if (!empty($this->request->data['upload']['name'])) {
                $recipe->IMAGE = $imageFileName;
            }
            $recipe = $this->Recipes->patchEntity($recipe, $this->request->getData());
            if ($this->Recipes->save($recipe)) {
                $RecipeProducts = $this->RecipeProducts->newEntities($this->request->getData('recipe_products'));
                foreach($RecipeProducts as $key => $RecipeProduct){
                    $RecipeProducts[$key]->RECIPE_ID =  $recipe->ID;

                }
                $this->RecipeProducts->saveMany($RecipeProducts);
                $this->Flash->success(__('La receta ha sido guardada con exito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
        }
        $products = $this->RecipeProducts->Products->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ],
        [
            'conditions' => [
                'DELETED' => 0
            ]
        ]);
        $unitsOfWeights = $this->RecipeProducts->UnitsOfWeights->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ]);
        $this->set(compact('recipe', 'products', 'unitsOfWeights'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Recipe id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $recipe = $this->Recipes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!empty($this->request->data['upload']['name'])) {
                $file = $this->request->data['upload']; //put the data into a var for easy use
                $dir = WWW_ROOT . 'img' .DS. 'recipes';

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);
                
                //only process if the extension is valid
                if (in_array($ext, $arr_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'],$dir.DS. $setNewFileName . '.' . $ext);
                
                    //prepare the filename for database entry 
                    $imageFileName = $setNewFileName . '.' . $ext;
                }
            }
            $recipe = $this->Recipes->patchEntity($recipe, $this->request->getData());
                
            if (!empty($this->request->data['upload']['name'])) {
                $recipe->IMAGE = $imageFileName;
            }
            if ($this->Recipes->save($recipe)) {
                $requestProd = $this->request->getData('recipe_products');
                foreach($requestProd as $key => $prod){
                    if(!isset($prod['ID'])){
                        $RecipeProducts = $this->RecipeProducts->newEntity($prod);
                    } else {
                        $RecipeProducts = $this->RecipeProducts->get($prod['ID']);
                        $RecipeProducts = $this->RecipeProducts->patchEntity($RecipeProducts, $prod);
                    }
                    $RecipeProducts->RECIPE_ID =  $recipe->ID;
                    $this->RecipeProducts->save($RecipeProducts);
                }
                $this->Flash->success(__('La receta ha sido guardada con exito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
        }
        $recipeProducts = $this->RecipeProducts->find('all', [
            'conditions' => [
                'RECIPE_ID' => $id
            ]
        ]);
        $products = $this->RecipeProducts->Products->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ],
        [
            'conditions' => [
                'DELETED' => 0
            ]
        ]);
        $unitsOfWeights = $this->RecipeProducts->UnitsOfWeights->find('list',[
            'KeyField' => 'ID',
            'valueField' => 'NAME'
        ]);
        $this->set(compact('recipe', 'products', 'unitsOfWeights', 'recipeProducts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Recipe id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $recipe = $this->Recipes->get($id);
        if ($this->Recipes->delete($recipe)) {
            $this->Flash->success(__('La receta se ha elimiado exitosamente.'));
        } else {
            $this->Flash->error(__("Ha ocurrido un error al momento de guardar los datos."));
        }

        return $this->redirect(['action' => 'index']);
    }
}
