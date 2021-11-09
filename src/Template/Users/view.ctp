<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('USERNAME') ?></th>
            <td><?= h($user->USERNAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PASSWORD') ?></th>
            <td><?= h($user->PASSWORD) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('NAME') ?></th>
            <td><?= h($user->NAME) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RUT') ?></th>
            <td><?= h($user->RUT) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('EMAIL') ?></th>
            <td><?= h($user->EMAIL) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= $this->Number->format($user->ID) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('GROUP ID') ?></th>
            <td><?= $this->Number->format($user->GROUP_ID) ?></td>
        </tr>
    </table>
</div>
