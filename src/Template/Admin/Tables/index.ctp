<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Table[]|\Cake\Collection\CollectionInterface $tables
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Table'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tables index large-9 medium-8 columns content">
    <h3><?= __('Tables') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PERSON_QUANTITY') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NAME') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DESCRIPTION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TABLE_STATUS_ID') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tables as $table): ?>
            <tr>
                <td><?= $this->Number->format($table->ID) ?></td>
                <td><?= $this->Number->format($table->PERSON_QUANTITY) ?></td>
                <td><?= h($table->NAME) ?></td>
                <td><?= h($table->DESCRIPTION) ?></td>
                <td><?= $this->Number->format($table->TABLE_STATUS_ID) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $table->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $table->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $table->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $table->ID)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
