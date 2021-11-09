<?= $this->Form->create($providerRequest) ?>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?=
            $this->Form->control('PROV_ID', [
                'label' => 'Proveedor (*)',
                'class' => 'form-control', 
                'required' => true,
                'options' => $providers,
                'empty' => 'Seleccione'
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center allProducts">
                <h4>Productos</h4>
                <button type="button" name="button" class="btn btn-danger btn-sm add-recipe-product pull-right" id="add-button"><i class="fa fa-plus fa-side"></i>Añadir</button>
                <tbody>
                    <tr class="recipe-products">
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th></th>
                    </tr>
                    <? if(isset($porRequestProd)): ?>
                        <? foreach($porRequestProd as $key => $prod): ?>
                            <tr>
                                <?= $this->Form->hidden('pro_request_prod.'.$key.'.ID', ['value'=>$prod->ID, 'class' => "id-recipe-product"]);?>
                                <td><?= $this->Form->control('pro_request_prod.'.$key.'.PROD_ID', ['type'=>'select','label' => false,'class' => 'form-control','empty' => 'Seleccione','options'=>$products, 'required','value'=>$prod->PROD_ID]);?></td>
                                <td><?= $this->Form->control('pro_request_prod.'.$key.'.QUANTITE', ['type' => 'number', 'label' => false,'class' => 'form-control','required','value'=>$prod->QUANTITE]);?></td>
                                <td><?= $this->Form->control('pro_request_prod.'.$key.'.UNIT_ID', ['type'=>'select','label' => false,'class' => 'form-control','empty' => 'Seleccione','options'=>$unitsOfWeights, 'required','value'=>$prod->UNIT_ID]);?></td>
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
    <div class="col-md-3">
        <div class="form-group">
            <?=
            $this->Form->control('PRICE', [
                'type' => 'number',
                'label' => 'Precio a Pedir (*)',
                'class' => 'form-control', 
                'required' => true
            ]);
            ?>
        </div>
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
                    <td><?= $this->Form->control('pro_request_prod.'.$keyValue.'.PROD_ID', ['type'=>'select','label' => false,'class' => 'form-control recipe-product','empty' => 'Seleccione','options'=>$products, 'required']);?></td>
                    <td><?= $this->Form->control('pro_request_prod.'.$keyValue.'.QUANTITE', ['type' => 'number', 'label' => false,'class' => 'form-control recipe-quantite','required']);?></td>
                    <td><?= $this->Form->control('pro_request_prod.'.$keyValue.'.UNIT_ID', ['type'=>'select','label' => false,'class' => 'form-control recipe-unit','empty' => 'Seleccione','options'=>$unitsOfWeights, 'required']);?></td>
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
                url: '/admin/provider-request/ajaxDeleteProductById',
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
               $(this).find('.recipe-product').attr("name", 'pro_request_prod['+keyProd+'][PROD_ID]');
               $(this).find('.recipe-quantite').attr("name", 'pro_request_prod['+keyProd+'][QUANTITE]');
               $(this).find('.recipe-unit').attr("name", 'pro_request_prod['+keyProd+'][UNIT_ID]');
               keyProd = keyProd + 1;
            });
        }
    });

    $('body').on('click', '.btn-delete-product-recipe', function(){
        $(this).closest('tr').remove();
    });
</script>