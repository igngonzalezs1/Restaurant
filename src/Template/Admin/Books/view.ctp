<section class="content-header">
  <h1>
    Book
    <small><?php echo __('View'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-info"></i>
          <h3 class="box-title"><?php echo __('Information'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt scope="row"><?= __('Name') ?></dt>
            <dd><?= h($book->name) ?></dd>
            <dt scope="row"><?= __('Sypnosis') ?></dt>
            <dd><?= h($book->sypnosis) ?></dd>
            <dt scope="row"><?= __('Book Dir') ?></dt>
            <dd><?= h($book->book_dir) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($book->id) ?></dd>
            <dt scope="row"><?= __('Cost') ?></dt>
            <dd><?= $this->Number->format($book->cost) ?></dd>
            <dt scope="row"><?= __('Dcto Percent') ?></dt>
            <dd><?= $this->Number->format($book->dcto_percent) ?></dd>
            <dt scope="row"><?= __('Stock') ?></dt>
            <dd><?= $this->Number->format($book->stock) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Shopping Carts') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($book->shopping_carts)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Cost') ?></th>
                    <th scope="col"><?= __('Book Id') ?></th>
                    <th scope="col"><?= __('Bill Id') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($book->shopping_carts as $shoppingCarts): ?>
              <tr>
                    <td><?= h($shoppingCarts->id) ?></td>
                    <td><?= h($shoppingCarts->cost) ?></td>
                    <td><?= h($shoppingCarts->book_id) ?></td>
                    <td><?= h($shoppingCarts->bill_id) ?></td>
                    <td><?= h($shoppingCarts->user_id) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'ShoppingCarts', 'action' => 'view', $shoppingCarts->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'ShoppingCarts', 'action' => 'edit', $shoppingCarts->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'ShoppingCarts', 'action' => 'delete', $shoppingCarts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shoppingCarts->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
              </tr>
              <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
