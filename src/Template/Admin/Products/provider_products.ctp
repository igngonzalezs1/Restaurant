<section class="content">
  <div class="row">
    <div class="col-md-9">
      <div class="box">
      <div class="box-header" >
         <h3 class="box-title">Lista de Productos por Proveedores</h3>
        </div>
        <div class="box-body table-responsive no-padding" >
          <table class="table table-hover">
            <thead>
              <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Unidad</th>
                  <th>Proveedor</th>
                  <th>Precio</th>
                  <th>Estado</th>
                  <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($providerProducts as $providerProduct): ?>
                <tr>
                  <td><?= $providerProduct->ID ?></td>
                  <td><?= $providerProduct->product->NAME ?></td>
                  <td><?= $providerProduct->QUANTITE ?></td>
                  <td><?= $providerProduct->units_of_weight->NAME ?></td>
                  <td><?= $providerProduct->provider->NAME ?></td>
                  <td><?= '$'.$this->Number->format($providerProduct->PRICE) ?></td>
                  <td><?= $providerProduct->ACTIVE ? "<i class='fa fa-check-circle' aria-hidden='true' style='color:green'></i>" : "<i class='fa fa-times-circle' aria-hidden='true' style='color:red'></i>"?></td>
                  <td>
                    <?= $this->Html->link('<i class="fa fa-edit"></i>',
                            ['action' => 'editProviderProduct', $providerProduct->ID],
                            [   
                                'class' => 'btn btn-box-tool btn-edit-product', 
                                'escape' => false, 
                                'title' => 'Editar',
                            ]);
                        ?>
                    <?= 
                       $this->Form->postLink('<i class="fa fa-trash"></i>', 
                            ['action' => 'deleteProviderProduct', $providerProduct->ID],[
                                'class' => 'btn btn-box-tool btn-delete-product', 
                                'escape' => false, 
                                'title' => 'Eliminar',
                            ]);
                    ?>
                    <?= 
                       $this->Form->postLink('<i class="fa fa-ban"></i>', 
                            ['action' => 'cancelProviderProduct', $providerProduct->ID],[
                                'class' => 'btn btn-box-tool btn-cancel-product', 
                                'escape' => false, 
                                'title' => 'cancelar',
                            ]);
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php if(count($providerProducts)>20):?>
          <div class="paginator">
              <ul class="pagination">
                  <?= $this->Paginator->prev('< Anterior') ?>
                  <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                  <?= $this->Paginator->next('Siguiente >') ?>
              </ul>
              <p><?= $this->Paginator->counter() ?></p>
          </div>
        <?php endif;?>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-3 special-box">
          <div class="box">
              <div class="box-header with-border">
                  <h3 class="box-title">Acciones</h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus icon-special"></i>
                      </button>
                  </div>
              </div>
              <div class="box-body">
              <?= $this->Form->create() ?>
                  <div class="row">
                    <div class="col-md-12">
                          <div class="form-group">
                              <?= $this->Form->control('ID', [
                                    'label' => 'Id',
                                    'class' => 'form-control',
                                    'type' => 'number',
                                    'min' => 0
                                ]); ?>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <?= $this->Form->control('NAME', [
                                    'label' => 'Nombre',
                                    'class' => 'form-control',
                                ]); ?>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="btn-toolbar">
                                <?= 
                                    $this->Form->button('Filtrar', [
                                        'class' => 'btn btn-danger',
                                        'type'=> 'submit'
                                    ]);
                                ?>
                              <?= 
                                $this->Html->link('Limpiar', 
                                  ['action' => 'providerProducts'],
                                  ['class' => 'btn btn-default pull-right',
                                  ]);
                                ?>
                              <?= 
                                $this->Html->link('Añadir', 
                                ['action' => 'addProviderProduct'],
                                  ['class' => 'btn btn-success pull-right btn-add-product',
                                  ]);
                                ?>
                              <?= $this->Form->end() ?>    
                          </div>
                      </div>
                  </div>
              </div>
          </div>

      </div>
  </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-delete-product').removeAttr('onclick');
        $('.btn-cancel-product').removeAttr('onclick');

        $('.btn-delete-product').click(function(e){
          e.preventDefault();
          var form = $(this).prev();
          url = $(form).attr("action");
          swal({
                buttons: {
                  cancel: "Cancelar",
                  confirm: "Estoy Seguro!"
                },
                title: '¿Estas seguro de eliminar este producto?',
                text: "Una vez eliminado no se podra recuperar!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'cancelar',
                confirmButtonText: 'Estoy seguro!',
                icon: "warning"
            }).then((result) => {
                if (result) {
                  $.post(url);
                  location.reload();
                }
            }) 
        });

        $('.btn-cancel-product').click(function(e){
          e.preventDefault();
          var form = $(this).prev();
          url = $(form).attr("action");
          swal({
                buttons: {
                  cancel: "Cancelar",
                  confirm: "Estoy Seguro!"
                },
                title: '¿Estas seguro de desactivar/activar este producto?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'cancelar',
                confirmButtonText: 'Estoy seguro!',
                icon: "warning"
            }).then((result) => {
                if (result) {
                  $.post(url);
                  location.reload();
                }
            }) 
        });
    });
</script>