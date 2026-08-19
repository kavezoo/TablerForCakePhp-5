<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Setup $setup
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Setup'), ['action' => 'edit', $setup->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Setup'), ['action' => 'delete', $setup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setup->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Setups'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Setup'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="setups view content">
            <h3><?= h($setup->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($setup->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($setup->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($setup->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Edit By') ?></th>
                    <td><?= h($setup->edit_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($setup->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($setup->pos) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($setup->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($setup->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Visible') ?></th>
                    <td><?= $setup->visible ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Value') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($setup->value)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>