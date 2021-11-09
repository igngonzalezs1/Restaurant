<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>El Restaurante | Login</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->Html->css([
            'icheck-bootstrap.min',
            'adminlte.min'
        ]) ?>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition login-page">
        
        <div class="login-box">
            <div class="login-logo">
                <a href="/Pages/home"><b>El </b>Restaurante</a>
            </div>

            <!-- /.login-logo -->
            <div class="card">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <!-- /.login-box -->

        <?= $this->Html->script([
            'jquery.min',
            'bootstrap.bundle.min',
            'adminlte.min'
        ]) ?>
    </body>
</html>
