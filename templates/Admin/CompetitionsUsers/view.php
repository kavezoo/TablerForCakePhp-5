<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionsUser $competitionsUser
 */
?>
<div class="page-header d-print-none mb-3 competitionsUsers">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('{0} megtekintése', __('Competitions User')) ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="card mb-3 competitionsUsers">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">
            <div class="col">
                <h3 class="card-title mb-0"><?= h($competitionsUser->user_id) ?></h3>
            </div>
            <div class="col-12 col-md-auto ms-md-auto">
                <div class="btn-list">
                    <?= $this->KvForm->actionEdit(['action' => 'edit', $competitionsUser->id]) ?>
                    <?= $this->KvForm->actionDelete(['action' => 'delete', $competitionsUser->id], (string)($competitionsUser->user_id ?? '')) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-sm table-bordered-vertical">
            <tbody>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('User') ?></th>
                    <td><?= $competitionsUser->hasValue('user') ? $this->Html->link(h($competitionsUser->user->first_name), ['controller' => 'Users', 'action' => 'view', $competitionsUser->user->id], ['class' => 'text-reset text-decoration-none fw-bold']) : '' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Competition') ?></th>
                    <td><?= $competitionsUser->hasValue('competition') ? $this->Html->link(h($competitionsUser->competition->title), ['controller' => 'Competitions', 'action' => 'view', $competitionsUser->competition->id], ['class' => 'text-reset text-decoration-none fw-bold']) : '' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Subclub') ?></th>
                    <td><?= $competitionsUser->hasValue('subclub') ? $this->Html->link(h($competitionsUser->subclub->name), ['controller' => 'Subclubs', 'action' => 'view', $competitionsUser->subclub->id], ['class' => 'text-reset text-decoration-none fw-bold']) : '' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Status') ?></th>
                    <td><?= h($competitionsUser->status) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Special Lunch') ?></th>
                    <td><?= h($competitionsUser->special_lunch) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Comment') ?></th>
                    <td><?= h($competitionsUser->comment) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Fee Paid By') ?></th>
                    <td><?= h($competitionsUser->fee_paid_by) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Result Recorded By Email') ?></th>
                    <td><?= h($competitionsUser->result_recorded_by_email) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Result Score') ?></th>
                    <td><?= h($competitionsUser->result_score) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Result Note') ?></th>
                    <td><?= h($competitionsUser->result_note) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($competitionsUser->id) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Lunch For The Attendant') ?></th>
                    <td><?= $competitionsUser->lunch_for_the_attendant === null ? '' : $this->Number->format($competitionsUser->lunch_for_the_attendant) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Companion Count') ?></th>
                    <td><?= $this->Number->format($competitionsUser->companion_count) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 1 Qty') ?></th>
                    <td><?= $competitionsUser->racing_pipe_1_qty === null ? '' : $this->Number->format($competitionsUser->racing_pipe_1_qty) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 2 Qty') ?></th>
                    <td><?= $competitionsUser->racing_pipe_2_qty === null ? '' : $this->Number->format($competitionsUser->racing_pipe_2_qty) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 3 Qty') ?></th>
                    <td><?= $competitionsUser->racing_pipe_3_qty === null ? '' : $this->Number->format($competitionsUser->racing_pipe_3_qty) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Entry Fee Amount') ?></th>
                    <td><?= $this->Number->format($competitionsUser->entry_fee_amount) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 1 Fee') ?></th>
                    <td><?= $this->Number->format($competitionsUser->racing_pipe_1_fee) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 2 Fee') ?></th>
                    <td><?= $this->Number->format($competitionsUser->racing_pipe_2_fee) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 3 Fee') ?></th>
                    <td><?= $this->Number->format($competitionsUser->racing_pipe_3_fee) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Lunch Fee') ?></th>
                    <td><?= $this->Number->format($competitionsUser->lunch_fee) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Fee Total') ?></th>
                    <td><?= $this->Number->format($competitionsUser->fee_total) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Result Time') ?></th>
                    <td><?= $competitionsUser->result_time === null ? '' : $this->Number->format($competitionsUser->result_time) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Result Rank') ?></th>
                    <td><?= $competitionsUser->result_rank === null ? '' : $this->Number->format($competitionsUser->result_rank) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($competitionsUser->pos) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Fee Paid At') ?></th>
                    <td><?= h($competitionsUser->fee_paid_at) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Created') ?></th>
                    <td><?= h($competitionsUser->created) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Modified') ?></th>
                    <td><?= h($competitionsUser->modified) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Visible') ?></th>
                    <td><?= $competitionsUser->visible ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<?= $this->element('KvAdmin.modal-delete') ?>
<?php
$this->Html->scriptBlock(
    "
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.table tbody tr[data-edit-url]').forEach(function (row) {
            row.addEventListener('dblclick', function (e) {
                if (e.target.closest('a, button, input, select, textarea, label, .actions')) {
                    return;
                }

                const editUrl = row.getAttribute('data-edit-url');
                if (editUrl) {
                    window.location.href = editUrl;
                }
            });
        });
    });
    ",
    ['block' => 'footer']
);
?>