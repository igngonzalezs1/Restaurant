
<div >
    <div class="col-md-5">
        <div class="box">
            <?= $this->Form->create(null, [
                'id' => 'form',
                'method' => 'post'
            ]) ?>
                <div class="card rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-success text-white text-center py-2">
                            <h3><i class="fa fa-envelope"></i> Contactanos</h3>
                            <p class="m-0" style="color:white">Con gusto te ayudaremos</p>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <!--Body-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user text-success"></i></span>
                                <?= $this->Form->control('name', [
                                    'class' => 'form-control',
                                    'label' => false,
                                    'type' => 'text',
                                    'placeholder' => 'Nombre y Apellido',
                                    'id' => 'nombre',
                                    'required'
                                ]) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope text-success"></i></span>
                                <?= $this->Form->control('email', [
                                    'class' => 'form-control',
                                    'label' => false,
                                    'type' => 'email',
                                    'placeholder' => 'ejemplo@gmail.com',
                                    'id' => 'email',
                                    'required'
                                ]) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-comment text-success"></i></span>
                                <?= $this->Form->control('email', [
                                    'class' => 'form-control',
                                    'label' => false,
                                    'type' => 'textarea',
                                    'placeholder' => 'Envianos tu Mensaje',
                                    'id' => 'msg',
                                    'required',
                                    'style' => "max-height:300px"
                                ]) ?>
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" value="Enviar" id="submitForm" class="btn btn-success btn-block rounded-0 py-2">
                        </div>
                    </div>

                </div>
            <? $this->Form->end; ?>
        </div>
    </div>
    <div class="col-md-7">
        <div class="box box-primary">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13319.202310616552!2d-70.60977050116202!3d-33.42844316881111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662cf7b8af466fd%3A0xc8fd2d768e783103!2sDuoc%20UC%3A%20Antonio%20Varas!5e0!3m2!1ses!2scl!4v1568118447788!5m2!1ses!2scl" style="width:100%; height:40em;" frameborder="0"  allowfullscreen=""></iframe> 
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#form').on('submit',function(e) {
            e.preventDefault();
            var $array = $('#form').serializeArray();

            $.ajax({
                method: "post",
                url: "/pages/send-contact",
                data: $array,
                beforeSend: function() {
                    swal({
                        title: "Procesando Solicitud",
                        text: "Su solicitud se esta procesando, espere un momento.",
                        icon: "info",
                        buttons: false,
                        closeOnEsc: false,
                        closeOnClickOutside: false,
                    });
                },
                success: function (response) {
                    swal('Solicitud satisfactoria','Se realizo el envio de correo electronico.', 'success');
                },
                error: function() {
                    swal('Error','Contacte un administrador.', 'error');
                }
            });

        });
    });
</script>

