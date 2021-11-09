<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: white;">
                <hr style="border: 40px solid #001133;">
            </div>
            <div class="panel-body">
                <h3 class="panel-title">Detalle de la venta</h3>
                <br>
                <table class="table table-condensed">
                <thead>
                    <tr>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Valor con Iva</th>
                    <th>Valor Unitario</th>
                    <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $subTotal =0;
                    $iva = 0;
                    $total = 0;
                ?>
                <?php foreach ($saleRequests as $saleRequest): ?>
                    <tr>
                    <td><?= $saleRequest->QUANTITY ?></td>
                    <td><?= $saleRequest->recipe->NAME?></td>
                    <td><?= $saleRequest->recipe->IVA ? 'Si' : 'No' ?></td>
                    <td><?= '$'.$this->Number->format($saleRequest->recipe->PRICE)?></td>
                    <td><?php 
                        if($saleRequest->recipe->IVA){
                            $subTotalSale = $saleRequest->QUANTITY * $saleRequest->recipe->PRICE;
                        } else {
                            $subTotalSale = $saleRequest->QUANTITY * ($saleRequest->recipe->PRICE*1.19);
                        }
                        $subTotal += $subTotalSale;
                        $iva += $saleRequest->recipe->PRICE * 0.19;
                        if($saleRequest->recipe->IVA){
                            $total += $subTotalSale;
                        } else {
                            $total += $subTotalSale+($saleRequest->recipe->PRICE * 0.19);
                        }
                        echo '$'.$this->Number->format($subTotalSale);
                    ?>
                    </td>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Subtotal:</td>
                        <td><?= '$'.$this->Number->format($subTotal)?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Iva(19%):</td>
                        <td><?= '$'.$this->Number->format($iva)?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total:</td>
                        <td><?= '$'.$this->Number->format($total)?></td>
                    </tr>
                </tbody>
                </table>
            </div> <!-- panel body -->
            <div class="panel-footer" style="background-color: white;">
                <hr style="border: 40px solid #001133;"> 
                <?= $this->Html->link('Solicitar Cuenta',
                        'javascript:void(0)',
                    [
                        'title'=>'Asignar Mesa',
                        'class'=>'btn btn-danger btn-sale',
                    ]);
                ?>
            </div>
        </div>
    </div>
</div>
<div id="modal-sale-account" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <center><h3 class="modal-title">Seleccione el metodo de pago</h3></center>
        </div>
      <div class="modal-body">
        <div class="col-md-6">
            <center>
                <?= $this->Form->postLink('<i class="fa fa-money" style="font-size: 50px;"></i>', [
                        'action' => 'cashPay', $saleRequest->RESER_ID
                    ],[
                        'escape' => false, 'title'=>'Efectivo',
                        'class'=>'btn btn-box-tool',
                        'style' => "text-align: left !important;"
                    ]);
                ?>
            </center>
        </div>
        <div class="col-md-6">
            <center>
                <?= $this->Form->postLink('<i class="fa fa-credit-card-alt" style="font-size: 50px;"></i>', [
                        'action' => 'creditPay', $saleRequest->RESER_ID
                    ],[
                        'escape' => false, 'title'=>'Crédito / Debito',
                        'class'=>'btn btn-box-tool',
                        'style' => "text-align: left !important;"
                    ]);
                ?>
            </center>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    var $modal = $('#modal-sale-account');
    $(document).ready(function(){
        $('.btn-sale').click(function(e){
            e.preventDefault();
            var recipeId = $(this).data('recipe-id');
            $modal.modal('show');

        });
    });
</script>

