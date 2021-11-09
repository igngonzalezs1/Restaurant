<section class="content-header">
  <h1>
    Shopping Cart
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
            <dt scope="row"><?= __('Cost') ?></dt>
            <dd><?= h($shoppingCart->cost) ?></dd>
            <dt scope="row"><?= __('Book') ?></dt>
            <dd><?= $shoppingCart->has('book') ? $this->Html->link($shoppingCart->book->name, ['controller' => 'Books', 'action' => 'view', $shoppingCart->book->id]) : '' ?></dd>
            <dt scope="row"><?= __('Bill') ?></dt>
            <dd><?= $shoppingCart->has('bill') ? $this->Html->link($shoppingCart->bill->name, ['controller' => 'Bills', 'action' => 'view', $shoppingCart->bill->id]) : '' ?></dd>
            <dt scope="row"><?= __('User') ?></dt>
            <dd><?= $shoppingCart->has('user') ? $this->Html->link($shoppingCart->user->name, ['controller' => 'Users', 'action' => 'view', $shoppingCart->user->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($shoppingCart->id) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
