<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Añadir libro</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/books/index">Libros</a></li>
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Añadir libro</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <?= $this->Form->create($book, ['type' => 'file']) ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $this->Form->control('name', [
                                    'class' => 'form-control',
                                    'label' => 'Nombre',
                                    'placeholder' => 'Nombre'
                                ]); ?>
                            </div>
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <?= $this->Form->control('cost', [
                                            'class' => 'form-control',
                                            'label' => 'Valor',
                                            'placeholder' => 'Valor'
                                        ]); ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <?= $this->Form->control('book_dir', [
                                            'class' => 'form-control',
                                            'label' => 'Imagen',
                                            'type' => 'file',
                                            'required'
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $this->Form->control('sypnosis', [
                                    'class' => 'form-control',
                                    'label' => 'Sipnosis',
                                    'placeholder' => 'Sipnosis',
                                    'type' => 'textarea',
                                    'rows' => '5',
                                    'style' => 'resize: none;'

                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="/admin/books/index" class="btn btn-secondary float-left">Cancelar</a>
                    <?= $this->Form->control('Guardar', ['escape' => false, 'type'=>'submit', 'class' => 'btn btn-success float-right']); ?>
                </div>
                <?= $this->Form->end; ?>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
<!-- /.content -->