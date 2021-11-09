<section class="content">
  <div class="row">
    <div class="col-md-9">
      <div class="box">
      <div class="box-header" >
         <h3 class="box-title">Pedidos Proveedores</h3>
        </div>
        <div class="box-body table-responsive no-padding" >
          <table class="table table-hover">
            <thead>
              <tr>
                  <th>Id</th>
                  <th>Proveedor</th>
                  <th>Productos</th>
                  <th>Valor Total</th>
                  <th>Estado</th>
                  <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($providerRequests as $providerRequest): ?>
                <tr>
                  <td><?= $providerRequest->ID ?></td>
                  <td><?= $providerRequest->provider->NAME ?></td>
                  <td><?php 
                        foreach($providerRequest->pro_request_prod  as $prod){ 
                            echo $prod->product->NAME." / ".$prod->QUANTITE." / ".$prod->units_of_weight->CODE.'<br>';
                        }
                   ?></td>
                  <td><?= $providerRequest->PRICE ?></td>
                  <td><?= $providerRequest->request_prod_status->NAME?></td>
                  <td>
                    <?php  
                        if($current_user['GROUP_ID'] == 0){
                            if($providerRequest->STATUS_ID == 0){
                              echo $this->Form->postLink('<i class="fa fa-check"></i>',
                              ['action' => 'toAccept', $providerRequest->ID],
                              [   
                                  'class' => 'btn btn-box-tool', 
                                  'escape' => false, 
                                  'title' => 'Aceptar',
                              ]);
                              echo $this->Form->postLink('<i class="fa fa-times"></i>',
                              ['action' => 'toRefuse', $providerRequest->ID],
                              [   
                                  'class' => 'btn btn-box-tool', 
                                  'escape' => false, 
                                  'title' => 'Rechazar',
                              ]);
                            }
                            echo $this->Html->link('<i class="fa fa-edit"></i>',
                            ['action' => 'edit', $providerRequest->ID],
                            [   
                                'class' => 'btn btn-box-tool', 
                                'escape' => false, 
                                'title' => 'Editar',
                            ]);
                            echo $this->Form->postLink('<i class="fa fa-trash"></i>', 
                            ['action' => 'deleted', $providerRequest->ID],[
                                'class' => 'btn btn-box-tool btn-delete', 
                                'escape' => false, 
                                'title' => 'Eliminar',
                            ]);
                        } else {
                          if($providerRequest->STATUS_ID == 0){
                              echo $this->Html->link('<i class="fa fa-edit"></i>',
                              ['action' => 'edit', $providerRequest->ID],
                              [   
                                  'class' => 'btn btn-box-tool', 
                                  'escape' => false, 
                                  'title' => 'Editar',
                              ]);
                              echo $this->Form->postLink('<i class="fa fa-trash"></i>', 
                              ['action' => 'deleted', $providerRequest->ID],[
                                  'class' => 'btn btn-box-tool btn-delete', 
                                  'escape' => false, 
                                  'title' => 'Eliminar',
                              ]);
                          }
                        }
                    ?> 
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php if(count($providerRequests)>20):?>
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
                              <?= $this->Form->control('NAME_PROVIDER', [
                                    'label' => 'Nombre Proveedor',
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
                                  ['action' => 'index'],
                                  ['class' => 'btn btn-default pull-right',
                                  ]);
                                ?>
                              <?= 
                                $this->Html->link('Añadir', 
                                ['action' => 'add'],
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
        $('.btn-delete').removeAttr('onclick');

        $('.btn-delete').click(function(e){
          e.preventDefault();
          var form = $(this).prev();
          url = $(form).attr("action");
          swal({
                buttons: {
                  cancel: "Cancelar",
                  confirm: "Estoy Seguro!"
                },
                title: '¿Estas seguro de eliminar este pedido?',
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
    });
</script>