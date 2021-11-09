<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
      <div class="box-header" >
         <h3 class="box-title">Solicitudes de Pago</h3>
        </div>
        <div class="box-body table-responsive no-padding" >
          <table class="table table-hover">
            <thead>
              <tr>
                  <th>Mesa</th>
                  <th>Tipo de Solicitud</th>
                  <th>Total a Pagar</th>
                  <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($reservations as $key => $reservation):?>
                <tr>
                  <td><?= $reservation['TABLE'] ?></td>
                  <td><?php 
                    if($reservation['TYPE'] == 2){
                        $icon = "fa fa-money";
                        echo "Pago en Efectivo";
                    } else {
                        $icon = "fa fa-credit-card-alt";
                        echo "Pago con Tarjeta";
                    }
                  ?>
                  </td>
                  <td><?= '$'.$this->Number->format($reservation['TOTAL']) ?></td>
                  <td>
                    <?= 
                        $this->Form->postLink('<i class="'.$icon.'"></i>', 
                            ['action' => 'payAccount', $reservation['ID'], $reservation['TOTAL']],[
                                'class' => 'btn btn-default pull-right',
                                'class' => 'btn btn-box-tool', 
                                'escape' => false, 
                                'title' => 'Cobrar',
                            ]);
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</section>