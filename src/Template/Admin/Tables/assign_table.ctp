<section class="content">
    <div class="row justify-content-around">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive no-padding" style="font-weight: 400;">
                    <div class="mdb-lightbox row">
                        <? if(!empty($tables->toArray())):?>
                            <?php foreach($tables as $table): ?>
                                <figure class="col-md-4">
                                    <div style=" text-transform: capitalize" >
                                        <? if($table->TABLE_STATUS_ID == 1): ?>
                                            <?= $this->Form->postLink('<i class="fa fa-ban" style="font-size: 20px; color: red;"></i>', [
                                                    'action' => 'cancel',
                                                    $table->ID
                                                ],[
                                                    'escape' => false, 'title'=>'Cancelar',
                                                    'class'=>'btn btn-box-tool cancel btn-cancel-table',
                                                    'style' => "text-align: left !important;"
                                                ]);
                                            ?>
                                        <? else: ?>
                                            <?= $this->Html->link('<i class="fa fa-user-plus" style="font-size: 20px; float:right !important;"></i>',
                                                    'javascript:void(0)',
                                                [
                                                    'escape' => false, 'title'=>'Asignar Mesa',
                                                    'class'=>'btn btn-box-tool assigned',
                                                    'data-id' => $table->ID,
                                                    'data-toggle' => "modal",
                                                    'data-target' => "#modal-assigned-table"
                                                ]);
                                            ?>
                                        <? endif; ?>
                                        <center><p><?= $table->NAME?></p></center>
                                        <div class="col-md-12">
                                            <center>
                                                <? if($table->TABLE_STATUS_ID == 1): ?>
                                                    <?=  $this->Html->image('tables-red.png',['width'=>'200','height'=>'150','class'=>'img-fluid']) ?>
                                                <? else: ?> 
                                                    <?=  $this->Html->image('tables.png',['width'=>'200','height'=>'150','class'=>'img-fluid']) ?>
                                                <? endif; ?>
                                            </center>
                                        </div> 
                                        <div class="col-md-12">
                                            <table class="table table-hover">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Sillas: </th>
                                                        <th>Descripción: </th>
                                                        <th>Estado: </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $table->PERSON_QUANTITY ?></td>
                                                        <td><?= $table->DESCRIPTION ?></td>
                                                        <td><?php 
                                                            switch($table->TABLE_STATUS_ID){
                                                                case 0:
                                                                    echo "Disponible";
                                                                break;
                                                                case 1:
                                                                    echo "Ocupado";
                                                                break;
                                                            };
                                                        ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> 
                                    </div>
                                    <br>
                                </figure>
                            <?php endforeach; ?>
                        <? else: ?> 
                            <p>No hay mesas registradas.</p>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="modal-assigned-table" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog large" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center><h6 class="modal-title">Seleccione una opción</h6></center>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">                      
                    <div class="col-md-6">
                        <center>
                            <?= $this->Html->link('<i class="fa fa-user-plus" style="font-size: 50px;"></i>', [
                                    'action' => 'addUserTable'
                                ],[
                                    'escape' => false, 'title'=>'Crear nuevo usuario',
                                    'class'=>'btn btn-box-tool addNewUser',
                                    'id' => 'addNewUser',
                                    'style' => "text-align: left !important;"
                                ]);
                            ?>
                        </center>
                    </div>
                    <div class="col-md-6">
                        <center>
                            <?= $this->Html->link('<i class="fa fa-users" style="font-size: 50px;"></i>', [
                                    'action' => 'assignedUserTable'
                                ],[
                                    'escape' => false, 'title'=>'Asignar usuario existente',
                                    'class'=>'btn btn-box-tool selectUser',
                                    'id' => 'selectUser',
                                    'style' => "text-align: left !important;"
                                ]);
                            ?>
                        </center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var $modalAssigned = $('#modal-assigned-table');
        $('.assigned').click(function(e){
            e.preventDefault();
            var tableId = $(this).data('id');
            $('#addNewUser').attr('href','/admin/tables/addUserTable/'+tableId);
            $('#selectUser').attr('href','/admin/tables/assignedUserTable/'+tableId);
        });

        $('.btn-cancel-table').removeAttr('onclick');

        $('.btn-cancel-table').click(function(e){
            e.preventDefault();
            var form = $(this).prev();
            url = $(form).attr("action");
            swal({
                    buttons: {
                    cancel: "Cancelar",
                    confirm: "Estoy Seguro!"
                    },
                    title: '¿Esta seguro de cancelar esta reserva?',
                    text: "Una vez cancelada la mesa quedara disponible",
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