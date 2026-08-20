<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FailedPasswordAttempt $failedPasswordAttempt
 */
?>
<div class="page-header d-print-none mb-3 failedPasswordAttempts">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('{0} megtekintése', __('Failed Password Attempt')) ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="card mb-3 failedPasswordAttempts">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">
            <div class="col">
                <h3 class="card-title mb-0"><?= h($failedPasswordAttempt->id) ?></h3>
            </div>
            <div class="col-12 col-md-auto ms-md-auto">
                <div class="btn-list">
                    <?= $this->KvForm->actionEdit(['action' => 'edit', $failedPasswordAttempt->id]) ?>
                    <?= $this->KvForm->actionDelete(['action' => 'delete', $failedPasswordAttempt->id], (string)($failedPasswordAttempt->id ?? '')) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-sm table-bordered-vertical">
            <tbody>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Id') ?></th>
                    <td><?= h($failedPasswordAttempt->id) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('User') ?></th>
                    <td><?= $failedPasswordAttempt->hasValue('user') ? $this->Html->link(h($failedPasswordAttempt->user->first_name), ['controller' => 'Users', 'action' => 'view', $failedPasswordAttempt->user->id], ['class' => 'text-reset text-decoration-none fw-bold']) : '' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Created') ?></th>
                    <td><?= h($failedPasswordAttempt->created) ?></td>
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