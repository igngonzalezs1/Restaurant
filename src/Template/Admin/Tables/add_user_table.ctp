<section class="content">
  <div class="row">
    <div class="col-md-9">
      <div class="box">
        <div class="box-header">
            <h3 class="box-title">Asignar nuevo Comensal</h3>
        </div>
        <div class="box-body table-responsive no-padding" >
            <?= $this->Form->create() ?>
            <div class="row">
                <div class="col-md-3">
                    <?= 
                        $this->Form->control('NAME',[
                            'label' => 'Nombre Completo (*)',
                            'class' => 'form-control',
                            'required' => true
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->control('EMAIL',[
                            'label' => 'Correo Electronico',
                            'class' => 'form-control',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->control('RUT',[
                            'label' => 'Rut (*)',
                            'class' => 'form-control',
                            'required' => true
                        ]);
                    ?>
                </div>
            </div>
        </div>
      </div>
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
                      <div class="col-md-12">
                          <div class="btn-toolbar">
                                <?= 
                                    $this->Form->button('Guardar', [
                                        'class' => 'btn btn-danger',
                                        'type'=> 'submit'
                                    ]);
                                ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <?= $this->Form->end() ?>    
      </div>
  </div>
</section>