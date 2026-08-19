<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FailedPasswordAttempt $failedPasswordAttempt
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Failed Password Attempt'), ['action' => 'edit', $failedPasswordAttempt->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Failed Password Attempt'), ['action' => 'delete', $failedPasswordAttempt->id], ['confirm' => __('Are you sure you want to delete # {0}?', $failedPasswordAttempt->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Failed Password Attempts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Failed Password Attempt'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="failedPasswordAttempts view content">
            <h3><?= h($failedPasswordAttempt->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($failedPasswordAttempt->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $failedPasswordAttempt->hasValue('user') ? $this->Html->link($failedPasswordAttempt->user->username, ['controller' => 'Users', 'action' => 'view', $failedPasswordAttempt->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($failedPasswordAttempt->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>