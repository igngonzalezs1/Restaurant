<div class="col-md-12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Pedidos Pendientes!</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover ">
                            <tbody>
                                <tr class="active">
                                    <th>Núm Orden</th>
                                    <th>Receta</th>
                                    <th>Mesa</th>
                                    <th>Tiem. Preparación</th>
                                    <th>Tiem. Restante</th>
                                    <th>Petición Especial</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                                <?php foreach ($saleRequests as $saleRequest):?>
                                <tr>
                                    <td>
                                        #<?= $saleRequest->ID ?>
                                    </td>
                                    <td>
                                        <?= $saleRequest->recipe->NAME ?>
                                    </td>
                                    <td>
                                        <?= $saleRequest->reservation->table->NAME ?>
                                    </td>
                                    <td>
                                        <? 
                                            if($saleRequest->recipe->PREPARATION_TIME/60 < 1){
                                                echo $saleRequest->recipe->PREPARATION_TIME." Minutos";
                                            } else {
                                                echo round($saleRequest->recipe->PREPARATION_TIME/60).':'.($saleRequest->recipe->PREPARATION_TIME - (round($saleRequest->recipe->PREPARATION_TIME/60)*60))." Hora/s";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php   
                                            $dateNow = new DateTime();
                                            $dateRequest = new DateTime($saleRequest->CREATED);
                                            $minutosRestantes = $dateNow->diff($dateRequest);
                                            echo $minutosRestantes->format('%H horas %i minutos %s segundos');                                        
                                        ?>
                                    </td>
                                    <td>
                                        <?= $saleRequest->OBSERVATIONS ?>
                                    </td>
                                    <td>
                                        <?= $saleRequest->SaleRequestStatus['NAME'] ?>
                                    </td>
                                    <td>
                                        <?= $this->Html->link('<i class="fa fa-repeat"></i>',[
                                                'action' => 'reloadStatus', $saleRequest->ID], [
                                                'class' => 'btn btn-box-tool', 
                                                'escape' => false, 
                                                'title' => 'Actualizar'
                                            ]);
                                        ?>
                                        <?= $this->Html->link('<i class="fa fa-ban"></i>',
                                            'javascript:void(0)',
                                            [
                                                'class' => 'btn btn-box-tool btn-cancel-sale', 
                                                'escape' => false, 
                                                'title' => 'Actualizar',
                                                'data-sale-request-id' => $saleRequest->ID
                                            ]);
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal-cancel-sale-request" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <?= $this->Form->create('',['action' => 'cancelSaleRequest']) ?>
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12" style="color: red;">
              <center>
                <h1><i class="fa fa-exclamation-triangle" ></i></h1>
                <h4>Por favor, indique el motivo de la cancelación</h4>
              </center>
          </div>
          <div class="col-md-12">
            <?php
                echo $this->Form->control('CANCELATIONS', [
                    'type' => 'textarea',
                    'class' => 'form-control input-comment',
                    'label' => 'Motivo',
                    'rows' => 5,
                    'style' => 'height: auto !important;'
                ]);
            ?>
            <?= $this->Form->hidden('ID',['id' => 'sale-request-id'])?>
          </div>
        </div>
      </div>
        <div class="modal-footer">
            <?=$this->Form->input('Cancelar', [
                'type' => 'submit',
                'label' => false,
                'class' => 'btn btn-danger replace', 
            ])?>
        </div>
      <?= $this->Form->end() ?>    
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var $modalSaleRequest = $('#modal-cancel-sale-request');
        $('.btn-cancel-sale').click(function(e){
            $('#sale-request-id').val($(this).data('sale-request-id'));
            $modalSaleRequest.modal('show');
        });
    });
</script>
