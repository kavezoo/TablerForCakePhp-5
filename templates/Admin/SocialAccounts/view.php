<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SocialAccount $socialAccount
 */
?>
<div class="page-header d-print-none mb-3 socialAccounts">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('{0} megtekintése', __('Social Account')) ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="card mb-3 socialAccounts">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">
            <div class="col">
                <h3 class="card-title mb-0"><?= h($socialAccount->provider) ?></h3>
            </div>
            <div class="col-12 col-md-auto ms-md-auto">
                <div class="btn-list">
                    <?= $this->KvForm->actionEdit(['action' => 'edit', $socialAccount->id]) ?>
                    <?= $this->KvForm->actionDelete(['action' => 'delete', $socialAccount->id], (string)($socialAccount->provider ?? '')) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-sm table-bordered-vertical">
            <tbody>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Id') ?></th>
                    <td><?= h($socialAccount->id) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('User') ?></th>
                    <td><?= $socialAccount->hasValue('user') ? $this->Html->link(h($socialAccount->user->first_name), ['controller' => 'Users', 'action' => 'view', $socialAccount->user->id], ['class' => 'text-reset text-decoration-none fw-bold']) : '' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Provider') ?></th>
                    <td><?= h($socialAccount->provider) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Username') ?></th>
                    <td><?= h($socialAccount->username) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Reference') ?></th>
                    <td><?= h($socialAccount->reference) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Link') ?></th>
                    <td><?= h($socialAccount->link) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Token Secret') ?></th>
                    <td><?= h($socialAccount->token_secret) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Token Expires') ?></th>
                    <td><?= h($socialAccount->token_expires) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Created') ?></th>
                    <td><?= h($socialAccount->created) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Modified') ?></th>
                    <td><?= h($socialAccount->modified) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Active') ?></th>
                    <td><?= $socialAccount->active ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <h4 class="m-0 mb-2"><?= __('Avatar') ?></h4>
            <div class="text-secondary"><?= $this->Text->autoParagraph(h($socialAccount->avatar)); ?></div>
        </div>
        <div class="mb-3">
            <h4 class="m-0 mb-2"><?= __('Description') ?></h4>
            <div class="text-secondary"><?= $this->Text->autoParagraph(h($socialAccount->description)); ?></div>
        </div>
        <div class="mb-3">
            <h4 class="m-0 mb-2"><?= __('Data') ?></h4>
            <div class="text-secondary"><?= $this->Text->autoParagraph(h($socialAccount->data)); ?></div>
        </div>
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