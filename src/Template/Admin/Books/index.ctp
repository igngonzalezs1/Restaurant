<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado de libros</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/books/index">Libros</a></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Libros</h3>
        </div>
        <div class="card-body p-1">
            <table class="table projects">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Sipnosis</th>
                        <th>Valor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book) : ?>
                        <tr class="text-center">
                            <td><?= $this->Number->format($book->id) ?></td>
                            <td>
                                <center><div class="product-image-thumb"><img alt="<?= $book->name ?>" src="/<?=$book->book_dir?>"></div></center>
                            </td>
                            <td><?= h($book->name) ?></td>
                            <td><?= h($book->sypnosis) ?></td>
                            <td><?= $this->Number->format($book->cost) ?></td>
                            <td class="project-actions">
                                <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $book->id], ['escape' => false, 'class' => 'btn btn-xs', 'title' => 'Editar']) ?>
                                <?= $this->Form->postLink('<i class="far fa-trash-alt"></i>', ['action' => 'delete', $book->id], ['confirm' => __('¿Estas seguro que deseas eliminar esto?'), 'escape' => false, 'class' => 'btn btn-xs', 'title' => 'Eliminar']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <?php if($books->count() == 0){
                echo "<center><h4>No existen datos</h4></center>";
            } ?>
        </div>
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->