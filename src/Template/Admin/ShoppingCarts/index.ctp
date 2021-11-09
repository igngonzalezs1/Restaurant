<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Shopping Carts

    <div class="pull-right"><?php echo $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?php echo __('List'); ?></h3>

          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="<?php echo __('Search'); ?>">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('cost') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('book_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('bill_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($shoppingCarts as $shoppingCart): ?>
                <tr>
                  <td><?= $this->Number->format($shoppingCart->id) ?></td>
                  <td><?= h($shoppingCart->cost) ?></td>
                  <td><?= $shoppingCart->has('book') ? $this->Html->link($shoppingCart->book->name, ['controller' => 'Books', 'action' => 'view', $shoppingCart->book->id]) : '' ?></td>
                  <td><?= $shoppingCart->has('bill') ? $this->Html->link($shoppingCart->bill->name, ['controller' => 'Bills', 'action' => 'view', $shoppingCart->bill->id]) : '' ?></td>
                  <td><?= $shoppingCart->has('user') ? $this->Html->link($shoppingCart->user->name, ['controller' => 'Users', 'action' => 'view', $shoppingCart->user->id]) : '' ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $shoppingCart->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $shoppingCart->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $shoppingCart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shoppingCart->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>