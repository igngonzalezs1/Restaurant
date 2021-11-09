<section class="content-header">
  <h1>
    User
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
            <dd><?= h($user->name) ?></dd>
            <dt scope="row"><?= __('Password') ?></dt>
            <dd><?= h($user->password) ?></dd>
            <dt scope="row"><?= __('Email') ?></dt>
            <dd><?= h($user->email) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($user->id) ?></dd>
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
          <h3 class="box-title"><?= __('Bills') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($user->bills)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Password') ?></th>
                    <th scope="col"><?= __('Email') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col"><?= __('Bill State Id') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($user->bills as $bills): ?>
              <tr>
                    <td><?= h($bills->id) ?></td>
                    <td><?= h($bills->name) ?></td>
                    <td><?= h($bills->password) ?></td>
                    <td><?= h($bills->email) ?></td>
                    <td><?= h($bills->user_id) ?></td>
                    <td><?= h($bills->bill_state_id) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'Bills', 'action' => 'view', $bills->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'Bills', 'action' => 'edit', $bills->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bills', 'action' => 'delete', $bills->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bills->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
              </tr>
              <?php endforeach; ?>
          </table>
          <?php endif; ?>
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
          <?php if (!empty($user->shopping_carts)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Cost') ?></th>
                    <th scope="col"><?= __('Book Id') ?></th>
                    <th scope="col"><?= __('Bill Id') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($user->shopping_carts as $shoppingCarts): ?>
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
