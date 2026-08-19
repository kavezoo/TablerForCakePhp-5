<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SocialAccount $socialAccount
 */
?>
<div class="card mb-3">
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