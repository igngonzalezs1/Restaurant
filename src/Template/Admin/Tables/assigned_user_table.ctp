<section class="content">
  <div class="row">
    <div class="col-md-9">
      <div class="box">
      <div class="box-header" >
         <h3 class="box-title">Lista de Comensales</h3>
        </div>
        <div class="box-body table-responsive no-padding" >
          <table class="table table-hover">
            <thead>
              <tr>
                  <th>Nombre</th>
                  <th>Rut</th>
                  <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr>
                  <td><?= $user->NAME ?></td>
                  <td><?= $user->RUT ?></td>
                  <td >
                      <?= $this->Form->create() ?>
                      <?= $this->Form->hidden('TABLE_ID',['value' => $tableId]); ?>
                      <?= $this->Form->hidden('USER_ID',['value' => $user->ID]); ?>
                      <?= $this->Form->button('<i class="fa fa-user-plus"></i>', [
                                'type'=> 'submit',
                                'class' => 'btn btn-box-tool userSelect', 
                                'escape' => false, 
                                'title' => 'Añadir usuario'
                            ]);
                        ?>
                        <?= $this->Form->end() ?>    
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php if(count($users)>20):?>
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
                  <h3 class="box-title">Buscar Comensal</h3>
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
                              <?= $this->Form->control('NAME', [
                                    'label' => 'Nombre',
                                    'class' => 'form-control',
                                ]); ?>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <?= $this->Form->control('RUT', [
                                    'label' => 'Rut',
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
                                  ['action' => 'assignedUserTable'],
                                  ['class' => 'btn btn-default pull-right',
                                  ]);
                                ?>
                          </div>
                      </div>
                    <?= $this->Form->end() ?>    
                  </div>
              </div>
          </div>

      </div>
  </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {

    });
</script>