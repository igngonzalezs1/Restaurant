<section class="content">
  <div class="row">
    <div class="col-md-9">
      <div class="box">
      <div class="box-header" >
         <h3 class="box-title">Lista de Recetas</h3>
        </div>
        <div class="box-body table-responsive no-padding" >
          <table class="table table-hover">
            <thead>
              <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recipes as $recipe): ?>
                <tr>
                  <td><?= $recipe->ID ?></td>
                  <td><?= $recipe->NAME ?></td>
                  <td>
                    <?= $this->Form->button('<i class="fa fa-search"></i>',
                            [   
                                'type' => 'button',
                                'data-recipe-id' => $recipe->ID,
                                'class' => 'btn btn-box-tool btn-recipe-detail', 
                                'escape' => false, 
                                'title' => 'Ver',
                            ]);
                        ?>
                    <?= $this->Html->link('<i class="fa fa-edit"></i>',
                        ['action' => 'edit', $recipe->ID],
                        [   
                            'class' => 'btn btn-box-tool', 
                            'escape' => false, 
                            'title' => 'Editar',
                        ]);
                    ?>
                    <?= 
                       $this->Form->postLink('<i class="fa fa-trash"></i>', 
                            ['action' => 'delete', $recipe->ID],[
                                'class' => 'btn btn-box-tool btn-delete-recipe', 
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
        <?php if(count($recipes)>20):?>
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
<?php echo $this->element('Recipes/modal_recipe_detail') ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-delete-recipe').removeAttr('onclick');
        
        $('.btn-delete-recipe').click(function(e){
          e.preventDefault();
          var form = $(this).prev();
          url = $(form).attr("action");
          swal({
                buttons: {
                  cancel: "Cancelar",
                  confirm: "Estoy Seguro!"
                },
                title: '¿Estas seguro de eliminar esta receta?',
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
