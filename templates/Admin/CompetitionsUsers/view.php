<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionsUser $competitionsUser
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Competitions User'), ['action' => 'edit', $competitionsUser->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Competitions User'), ['action' => 'delete', $competitionsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionsUser->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Competitions Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Competitions User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="competitionsUsers view content">
            <h3><?= h($competitionsUser->user_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $competitionsUser->hasValue('user') ? $this->Html->link($competitionsUser->user->username, ['controller' => 'Users', 'action' => 'view', $competitionsUser->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Competition') ?></th>
                    <td><?= $competitionsUser->hasValue('competition') ? $this->Html->link($competitionsUser->competition->title, ['controller' => 'Competitions', 'action' => 'view', $competitionsUser->competition->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Subclub') ?></th>
                    <td><?= $competitionsUser->hasValue('subclub') ? $this->Html->link($competitionsUser->subclub->name, ['controller' => 'Subclubs', 'action' => 'view', $competitionsUser->subclub->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($competitionsUser->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Special Lunch') ?></th>
                    <td><?= h($competitionsUser->special_lunch) ?></td>
                </tr>
                <tr>
                    <th><?= __('Comment') ?></th>
                    <td><?= h($competitionsUser->comment) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fee Paid By') ?></th>
                    <td><?= h($competitionsUser->fee_paid_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Result Recorded By Email') ?></th>
                    <td><?= h($competitionsUser->result_recorded_by_email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Result Score') ?></th>
                    <td><?= h($competitionsUser->result_score) ?></td>
                </tr>
                <tr>
                    <th><?= __('Result Note') ?></th>
                    <td><?= h($competitionsUser->result_note) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($competitionsUser->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lunch For The Attendant') ?></th>
                    <td><?= $competitionsUser->lunch_for_the_attendant === null ? '' : $this->Number->format($competitionsUser->lunch_for_the_attendant) ?></td>
                </tr>
                <tr>
                    <th><?= __('Companion Count') ?></th>
                    <td><?= $this->Number->format($competitionsUser->companion_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 1 Qty') ?></th>
                    <td><?= $competitionsUser->racing_pipe_1_qty === null ? '' : $this->Number->format($competitionsUser->racing_pipe_1_qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 2 Qty') ?></th>
                    <td><?= $competitionsUser->racing_pipe_2_qty === null ? '' : $this->Number->format($competitionsUser->racing_pipe_2_qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 3 Qty') ?></th>
                    <td><?= $competitionsUser->racing_pipe_3_qty === null ? '' : $this->Number->format($competitionsUser->racing_pipe_3_qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Entry Fee Amount') ?></th>
                    <td><?= $this->Number->format($competitionsUser->entry_fee_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 1 Fee') ?></th>
                    <td><?= $this->Number->format($competitionsUser->racing_pipe_1_fee) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 2 Fee') ?></th>
                    <td><?= $this->Number->format($competitionsUser->racing_pipe_2_fee) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 3 Fee') ?></th>
                    <td><?= $this->Number->format($competitionsUser->racing_pipe_3_fee) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lunch Fee') ?></th>
                    <td><?= $this->Number->format($competitionsUser->lunch_fee) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fee Total') ?></th>
                    <td><?= $this->Number->format($competitionsUser->fee_total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Result Time') ?></th>
                    <td><?= $competitionsUser->result_time === null ? '' : $this->Number->format($competitionsUser->result_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Result Rank') ?></th>
                    <td><?= $competitionsUser->result_rank === null ? '' : $this->Number->format($competitionsUser->result_rank) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($competitionsUser->pos) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fee Paid At') ?></th>
                    <td><?= h($competitionsUser->fee_paid_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($competitionsUser->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($competitionsUser->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Visible') ?></th>
                    <td><?= $competitionsUser->visible ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>