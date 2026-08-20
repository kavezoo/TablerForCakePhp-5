<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmailTemplate $emailTemplate
 */
?>
<div class="page-header d-print-none mb-3 emailTemplates">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('{0} megtekintése', __('Email Template')) ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="card mb-3 emailTemplates">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">
            <div class="col">
                <h3 class="card-title mb-0"><?= h($emailTemplate->name) ?></h3>
            </div>
            <div class="col-12 col-md-auto ms-md-auto">
                <div class="btn-list">
                    <?= $this->KvForm->actionEdit(['action' => 'edit', $emailTemplate->id]) ?>
                    <?= $this->KvForm->actionDelete(['action' => 'delete', $emailTemplate->id], (string)($emailTemplate->name ?? '')) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-sm table-bordered-vertical">
            <tbody>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Name') ?></th>
                    <td><?= h($emailTemplate->name) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Slug') ?></th>
                    <td><?= h($emailTemplate->slug) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Subject') ?></th>
                    <td><?= h($emailTemplate->subject) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($emailTemplate->id) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($emailTemplate->pos) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Created') ?></th>
                    <td><?= h($emailTemplate->created) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Modified') ?></th>
                    <td><?= h($emailTemplate->modified) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Enabled') ?></th>
                    <td><?= $emailTemplate->enabled ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Visible') ?></th>
                    <td><?= $emailTemplate->visible ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <h4 class="m-0 mb-2"><?= __('Body Html') ?></h4>
            <div class="text-secondary"><?= $this->Text->autoParagraph(h($emailTemplate->body_html)); ?></div>
        </div>
        <div class="mb-3">
            <h4 class="m-0 mb-2"><?= __('Body Text') ?></h4>
            <div class="text-secondary"><?= $this->Text->autoParagraph(h($emailTemplate->body_text)); ?></div>
        </div>
    </div>
</div>


<?= $this->element('KvAdmin.modal-delete') ?>