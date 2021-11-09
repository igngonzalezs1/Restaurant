<section class="content">
  <div class="row">
    <div class="col-md-9">
      <div class="box">
      <div class="box-header" >
         <h3 class="box-title">Utilidad Diaria</h3>
        </div>
        <div class="box-body table-responsive no-padding" >
          <table class="table table-hover">
            <thead>
              <tr>
                  <th>Fecha</th>
                  <th>Ingresos</th>
                  <th>Egresos</th>
                  <th>Utilidad Diaria</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($utility as $key => $util):?>
                <tr>
                  <td><?= $key ?></td>
                  <td><?php
                        if(isset($util['ENTRY'])){
                            foreach($util['ENTRY'] as $entry){
                                echo $entry['COMMENTARY'].': '.'$'.$this->Number->format($entry['TOTAL_PRICE']).'<br>';
                            }
                        }
                    ?>
                  </td>
                  <td><?php
                        if(isset($util['EXPENSY'])){
                            foreach($util['EXPENSY'] as $expen){
                                echo $expen['COMMENTARY'].': '.'$'.$this->Number->format($expen['TOTAL_PRICE']).'<br>';
                            }
                        }
                    ?>
                  </td>
                  <td><?= '$'.$this->Number->format($util['TOTAL']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
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
              <?= $this->Form->create() ?>
                  <div class="row">
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
                                  ['action' => 'dailyUtility'],
                                  ['class' => 'btn btn-default pull-right',
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
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  } );
</script>