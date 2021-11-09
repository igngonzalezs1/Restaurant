<section class="content">
  <div class="row">
    <div class="col-md-9">
      <div class="box">
      <div class="box-header" >
         <h3 class="box-title">Lista de Productos</h3>
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
              <?php foreach ($products as $product): ?>
                <tr>
                  <td><?= $product->ID ?></td>
                  <td><?= $product->NAME ?></td>
                  <td>
                    <?= $this->Html->link('<i class="fa fa-edit"></i>',
                            'javascript:void(0)',
                            [
                                'class' => 'btn btn-box-tool btn-edit-product', 
                                'escape' => false, 
                                'title' => 'Editar',
                                'data-product-id' => $product->ID,
                                'data-product-name' => $product->NAME
                            ]);
                        ?>
                    <?= 
                        $this->Html->link('<i class="fa fa-ban"></i>', 
                            ['action' => 'cancel', $product->ID],[
                                'class' => 'btn btn-default pull-right',
                                'class' => 'btn btn-box-tool', 
                                'escape' => false, 
                                'title' => 'Cancelar',
                            ]);
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php if(count($products)>20):?>
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
                                  ['action' => 'index'],
                                  ['class' => 'btn btn-default pull-right',
                                  ]);
                                ?>
                              <?= 
                                $this->Html->link('Añadir', 
                                'javascript:void(0)',
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
<div id="modal-edit-product" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <?= $this->Form->create('',['id' => 'form-modal','action' => 'edit']) ?>
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
              <center>
                <h1 id="title-modal-edit"></h1>
              </center>
          </div>
          <div class="col-md-12">
            <?php
                echo $this->Form->control('NAME', [
                    'class' => 'form-control input-comment',
                    'label' => 'Nombre del Producto',
                    'rows' => 5,
                    'style' => 'height: auto !important;',
                    'id' => 'form-edit-name'
                ]);
            ?>
            <?= $this->Form->hidden('ID',['id' => 'product-edit-id'])?>
          </div>
        </div>
      </div>
        <div class="modal-footer">
            <?=$this->Form->input('Guardar', [
                'type' => 'submit',
                'label' => false,
                'class' => 'btn btn-success replace', 
            ])?>
        </div>
      <?= $this->Form->end() ?>    
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var $modalProduct = $('#modal-edit-product');
        $('.btn-edit-product').click(function(e){
            $('#product-edit-id').val($(this).data('product-id'));
            $('#form-edit-name').text($(this).data('product-name'));
            $('#title-modal-edit').text('Editar Producto');
            $modalProduct.modal('show');
        });
        $('.btn-add-product').click(function(e){
            $modalProduct.modal('show');
            $('#title-modal-edit').text('Añadir Producto');
            $('#form-modal').attr('action', '/admin/products/add');
        });
    });
</script>