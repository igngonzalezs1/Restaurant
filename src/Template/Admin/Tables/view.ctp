<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Table $table
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Table'), ['action' => 'edit', $table->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Table'), ['action' => 'delete', $table->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $table->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Tables'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Table'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tables view large-9 medium-8 columns content">
    <h3><?= h($table->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('NAME') ?></th>
            <td><?= h($table->NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DESCRIPTION') ?></th>
            <td><?= h($table->DESCRIPTION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= $this->Number->format($table->ID) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PERSON QUANTITY') ?></th>
            <td><?= $this->Number->format($table->PERSON_QUANTITY) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TABLE STATUS ID') ?></th>
            <td><?= $this->Number->format($table->TABLE_STATUS_ID) ?></td>
        </tr>
    </table>
</div>
