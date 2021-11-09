<?= $this->Form->create($recipe , ['enctype' => 'multipart/form-data']) ?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?=
            $this->Form->control('NAME', [
                'label' => 'Nombre de la receta (*)',
                'class' => 'form-control', 
                'required' => true
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?=
            $this->Form->control('PREPARATION_TIME', [
                'label' => 'Tiempo de preparación en minutos (*)',
                'class' => 'form-control', 
                'required' => true
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?=
            $this->Form->control('PRICE', [
                'label' => 'Precio (*)',
                'class' => 'form-control', 
                'required' => true
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?=
            $this->Form->control('IVA', [
                'type'=>'checkbox',
                'checked'=> $recipe->IVA ? true : false,
                'label' => 'Iva (*)',
                'class' => 'form-control', 
                'required' => true
            ]);
            ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?= $this->Form->control('DESCRIPTION', [
                'label' => 'Descripción',
                'class' => 'form-control imput_pago',
                'rows' => 3,
                'style' => 'height: auto !important;',
            ]); ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <?= $this->Form->control('MOD_PREPARATION', [
                'label' => 'Preparación',
                'class' => 'form-control imput_pago',
                'rows' => 3,
                'style' => 'height: auto !important;',
            ]); ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center allProducts">
                <h4>Ingredientes</h4>
                <button type="button" name="button" class="btn btn-danger btn-sm add-recipe-product pull-right" id="add-button"><i class="fa fa-plus fa-side"></i>Añadir</button>
                <tbody>
                    <tr class="recipe-products">
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th></th>
                    </tr>
                    <? if(isset($recipeProducts)): ?>
                        <? foreach($recipeProducts as $key => $recipeProduct): ?>
                            <tr>
                                <?= $this->Form->hidden('recipe_products.'.$key.'.ID', ['value'=>$recipeProduct->ID, 'class' => "id-recipe-product"]);?>
                                <td><?= $this->Form->control('recipe_products.'.$key.'.PROD_ID', ['type'=>'select','label' => false,'class' => 'form-control','empty' => 'Seleccione','options'=>$products, 'required','value'=>$recipeProduct->PROD_ID]);?></td>
                                <td><?= $this->Form->control('recipe_products.'.$key.'.QUANTITE', ['type' => 'number', 'label' => false,'class' => 'form-control','required','value'=>$recipeProduct->QUANTITE]);?></td>
                                <td><?= $this->Form->control('recipe_products.'.$key.'.UNIT_ID', ['type'=>'select','label' => false,'class' => 'form-control','empty' => 'Seleccione','options'=>$unitsOfWeights, 'required','value'=>$recipeProduct->UNIT_ID]);?></td>
                                <td>
                                    <a href="javascript:void(0)" title="Eliminar" class="btn-delete-save-product-recipe">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $keyValue = $key ?>
                        <? endforeach; ?>
                    <? endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <?= $this->Form->input('upload', ['type' => 'file', 'label' => 'Añadir Imagen']);?>
    </div>
</div>
<?= $this->Form->button(__('Guardar'),['class' => 'btn btn-danger']) ?>
<?= $this->Form->end() ?>
<script type="text/javascript">
    $(document).ready(function(){
        key = <?php isset($keyValue) ? $keyValue += 1 : $keyValue = 0; echo $keyValue?>;
        keyProd = key;
        keyQuantite = key;
        keyUnit = key;
        $('#add-button').click(function(){
            $(".recipe-products").after(`
                <tr class="tr-body">
                    <td><?= $this->Form->control('recipe_products.'.$keyValue.'.PROD_ID', ['type'=>'select','label' => false,'class' => 'form-control recipe-product','empty' => 'Seleccione','options'=>$products, 'required']);?></td>
                    <td><?= $this->Form->control('recipe_products.'.$keyValue.'.QUANTITE', ['type' => 'number', 'label' => false,'class' => 'form-control recipe-quantite','required']);?></td>
                    <td><?= $this->Form->control('recipe_products.'.$keyValue.'.UNIT_ID', ['type'=>'select','label' => false,'class' => 'form-control recipe-unit','empty' => 'Seleccione','options'=>$unitsOfWeights, 'required']);?></td>
                    <td>
                        <a href="javascript:void(0)" title="Eliminar" class="btn-delete-product-recipe">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            `);
            changeName();
        });

        $('.btn-delete-save-product-recipe').click(function(){
            tr = $(this).closest('tr');
            id = tr.find('.id-recipe-product').first().val();
            
            $.ajax({
                type: 'post',
                url: '/admin/recipes/ajaxDeleteProductById',
                data: {
                    id: id
                },
                success: function(data){
                    tr.remove();
                },
                error: function(e){
                    console.log(e);
                }
            });
        });

        function changeName(){
            $('.tr-body').each(function(){
               $(this).find('.recipe-product').attr("name", 'recipe_products['+keyProd+'][PROD_ID]');
               $(this).find('.recipe-quantite').attr("name", 'recipe_products['+keyProd+'][QUANTITE]');
               $(this).find('.recipe-unit').attr("name", 'recipe_products['+keyProd+'][UNIT_ID]');
               keyProd = keyProd + 1;
            });
        }
    });

    $('body').on('click', '.btn-delete-product-recipe', function(){
        $(this).closest('tr').remove();
    });
</script>