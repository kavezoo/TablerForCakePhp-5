<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subclub $subclub
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Subclub'), ['action' => 'edit', $subclub->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Subclub'), ['action' => 'delete', $subclub->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subclub->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Subclubs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Subclub'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="subclubs view content">
            <h3><?= h($subclub->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Club') ?></th>
                    <td><?= $subclub->hasValue('club') ? $this->Html->link($subclub->club->name, ['controller' => 'Clubs', 'action' => 'view', $subclub->club->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Competition') ?></th>
                    <td><?= $subclub->hasValue('competition') ? $this->Html->link($subclub->competition->title, ['controller' => 'Competitions', 'action' => 'view', $subclub->competition->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($subclub->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($subclub->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($subclub->pos) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($subclub->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($subclub->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Visible') ?></th>
                    <td><?= $subclub->visible ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Competitions Users') ?></h4>
                <?php if (!empty($subclub->competitions_users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Competition Id') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Lunch For The Attendant') ?></th>
                            <th><?= __('Companion Count') ?></th>
                            <th><?= __('Special Lunch') ?></th>
                            <th><?= __('Racing Pipe 1 Qty') ?></th>
                            <th><?= __('Racing Pipe 2 Qty') ?></th>
                            <th><?= __('Racing Pipe 3 Qty') ?></th>
                            <th><?= __('Comment') ?></th>
                            <th><?= __('Fee Paid At') ?></th>
                            <th><?= __('Fee Paid By') ?></th>
                            <th><?= __('Entry Fee Amount') ?></th>
                            <th><?= __('Racing Pipe 1 Fee') ?></th>
                            <th><?= __('Racing Pipe 2 Fee') ?></th>
                            <th><?= __('Racing Pipe 3 Fee') ?></th>
                            <th><?= __('Lunch Fee') ?></th>
                            <th><?= __('Fee Total') ?></th>
                            <th><?= __('Result Time') ?></th>
                            <th><?= __('Result Recorded By Email') ?></th>
                            <th><?= __('Result Rank') ?></th>
                            <th><?= __('Result Score') ?></th>
                            <th><?= __('Result Note') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($subclub->competitions_users as $competitionsUser) : ?>
                        <tr>
                            <td><?= h($competitionsUser->id) ?></td>
                            <td><?= h($competitionsUser->user_id) ?></td>
                            <td><?= h($competitionsUser->competition_id) ?></td>
                            <td><?= h($competitionsUser->status) ?></td>
                            <td><?= h($competitionsUser->lunch_for_the_attendant) ?></td>
                            <td><?= h($competitionsUser->companion_count) ?></td>
                            <td><?= h($competitionsUser->special_lunch) ?></td>
                            <td><?= h($competitionsUser->racing_pipe_1_qty) ?></td>
                            <td><?= h($competitionsUser->racing_pipe_2_qty) ?></td>
                            <td><?= h($competitionsUser->racing_pipe_3_qty) ?></td>
                            <td><?= h($competitionsUser->comment) ?></td>
                            <td><?= h($competitionsUser->fee_paid_at) ?></td>
                            <td><?= h($competitionsUser->fee_paid_by) ?></td>
                            <td><?= h($competitionsUser->entry_fee_amount) ?></td>
                            <td><?= h($competitionsUser->racing_pipe_1_fee) ?></td>
                            <td><?= h($competitionsUser->racing_pipe_2_fee) ?></td>
                            <td><?= h($competitionsUser->racing_pipe_3_fee) ?></td>
                            <td><?= h($competitionsUser->lunch_fee) ?></td>
                            <td><?= h($competitionsUser->fee_total) ?></td>
                            <td><?= h($competitionsUser->result_time) ?></td>
                            <td><?= h($competitionsUser->result_recorded_by_email) ?></td>
                            <td><?= h($competitionsUser->result_rank) ?></td>
                            <td><?= h($competitionsUser->result_score) ?></td>
                            <td><?= h($competitionsUser->result_note) ?></td>
                            <td><?= h($competitionsUser->visible) ?></td>
                            <td><?= h($competitionsUser->pos) ?></td>
                            <td><?= h($competitionsUser->created) ?></td>
                            <td><?= h($competitionsUser->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'CompetitionsUsers', 'action' => 'view', $competitionsUser->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CompetitionsUsers', 'action' => 'edit', $competitionsUser->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'CompetitionsUsers', 'action' => 'delete', $competitionsUser->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $competitionsUser->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>