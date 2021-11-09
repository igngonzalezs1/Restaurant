<section class="content">
  <div class="row">
    <div class="col-md-9">
      <div class="box">
      <div class="box-header" >
         <h3 class="box-title">Egresos</h3>
        </div>
        <div class="box-body table-responsive no-padding" >
          <table class="table table-hover">
            <thead>
              <tr>
                  <th>Id</th>
                  <th>Fecha</th>
                  <th>Descripción</th>
                  <th>Valor Egreso</th>
                  <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($salesBox as $sale): ?>
                <tr>
                  <td><?= $sale->ID ?></td>
                  <td><?= date('Y-m-d', strtotime($sale->CREATED)) ?></td>
                  <td><?= $sale->COMMENTARY ?></td>
                  <td><?= '$'.$this->Number->format($sale->TOTAL_PRICE) ?></td>
                  <td>
                    <?= $this->Html->link('<i class="fa fa-edit"></i>',
                            ['action' => 'editExpenses', $sale->ID],
                            [   
                                'class' => 'btn btn-box-tool', 
                                'escape' => false, 
                                'title' => 'Editar',
                            ]);
                        ?>
                    <?= 
                       $this->Form->postLink('<i class="fa fa-trash"></i>', 
                            ['action' => 'deletedExpenses', $sale->ID],[
                                'class' => 'btn btn-box-tool btn-delete', 
                                'escape' => false, 
                                'title' => 'Eliminar',
                            ]);
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php if(count($salesBox)>20):?>
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
                  <div class="row">
                  <?= $this->Form->create() ?>
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
                              <?= $this->Form->control('DATE', [
                                    'label' => 'Fecha',
                                    'class' => 'form-control datepicker',
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
                                  ['action' => 'expenses'],
                                  ['class' => 'btn btn-default pull-right',
                                  ]);
                                ?>
                              <?= 
                                $this->Html->link('Añadir', 
                                ['action' => 'addExpenses'],
                                  ['class' => 'btn btn-success pull-right',
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
                title: '¿Estas seguro de eliminar este egreso?',
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
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  } );
</script>