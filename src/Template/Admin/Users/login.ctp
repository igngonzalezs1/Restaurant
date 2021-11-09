<div class="card-body login-card-body">

    <form action="/admin/users/login" method="post">
        <div class="input-group mb-3">
            <input name="USERNAME" class="form-control" placeholder="ignacio.gonzalez", title="Nombre de usuario.">
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fa fa-user fa-2"></i>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input name="PASSWORD" type="password" class="form-control" placeholder="*********">
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fa fa-lock fa-2"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesion</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <div class="row">
        <div class="col-md-8">
            <p style="font-size:15px;"><a href="#">¿Olvidaste tu contraseña?</a></p>
        </div>
        <!-- <div class="col-md-4">
            <p style="font-size:15px;"><a href="register.html" class="text-center">Registrarse</a></p>
        </div> -->
    </div>
</div>
<!-- /.login-card-body -->