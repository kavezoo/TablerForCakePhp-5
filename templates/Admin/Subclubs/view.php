<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subclub $subclub
 */
?>
<div class="page-header d-print-none mb-3 subclubs">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('{0} megtekintése', __('Subclub')) ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="card mb-3 subclubs">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">
            <div class="col">
                <h3 class="card-title mb-0"><?= h($subclub->name) ?></h3>
            </div>
            <div class="col-12 col-md-auto ms-md-auto">
                <div class="btn-list">
                    <?= $this->KvForm->actionEdit(['action' => 'edit', $subclub->id]) ?>
                    <?= $this->KvForm->actionDelete(['action' => 'delete', $subclub->id], (string)($subclub->name ?? '')) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-sm table-bordered-vertical">
            <tbody>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Club') ?></th>
                    <td><?= $subclub->hasValue('club') ? $this->Html->link(h($subclub->club->name), ['controller' => 'Clubs', 'action' => 'view', $subclub->club->id], ['class' => 'text-reset text-decoration-none fw-bold']) : '' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Competition') ?></th>
                    <td><?= $subclub->hasValue('competition') ? $this->Html->link(h($subclub->competition->title), ['controller' => 'Competitions', 'action' => 'view', $subclub->competition->id], ['class' => 'text-reset text-decoration-none fw-bold']) : '' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Name') ?></th>
                    <td><?= h($subclub->name) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($subclub->id) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($subclub->pos) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Created') ?></th>
                    <td><?= h($subclub->created) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Modified') ?></th>
                    <td><?= h($subclub->modified) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Visible') ?></th>
                    <td><?= $subclub->visible ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
$hasRelatedRecords = false;
?>
<?php if (!empty($subclub->competitions_users)) { $hasRelatedRecords = true; } ?>
<?php if ($hasRelatedRecords): ?>
<div class="card">
    <div class="card-header">
        <?php $isFirstRelatedTab = true; ?>
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
            <?php if (!empty($subclub->competitions_users)): ?>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link<?= $isFirstRelatedTab ? ' active' : '' ?>"
                    data-bs-toggle="tab"
                    data-bs-target="#related-competitions_users"
                    type="button"
                    role="tab"
                >
                    <?= __('Competitions Users') ?>
                </button>
            </li>
            <?php $isFirstRelatedTab = false; ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="card-body tab-content">
        <?php $isFirstRelatedPane = true; ?>
        <?php if (!empty($subclub->competitions_users)): ?>
        <div class="tab-pane<?= $isFirstRelatedPane ? ' active show' : '' ?>" id="related-competitions_users" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
                    <thead>
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
                            <th class="actions w-1"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subclub->competitions_users as $competitionsUser): ?>
                        <tr data-edit-url="<?= $this->Url->build(['controller' => 'CompetitionsUsers', 'action' => 'edit', $competitionsUser->id]) ?>">
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
                                <div class="btn-list flex-nowrap align-items-center">
                                    <?= $this->KvForm->actionView(['controller' => 'CompetitionsUsers', 'action' => 'view', $competitionsUser->id], ['title' => __('View')]) ?>
                                    <?= $this->KvForm->actionEdit(['controller' => 'CompetitionsUsers', 'action' => 'edit', $competitionsUser->id], ['title' => __('Edit')]) ?>
                                    <?= $this->KvForm->actionDelete(['controller' => 'CompetitionsUsers', 'action' => 'delete', $competitionsUser->id], (string)($competitionsUser->id)) ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php $isFirstRelatedPane = false; ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

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