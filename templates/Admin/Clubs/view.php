<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Club $club
 */
?>
<div class="page-header d-print-none mb-3 clubs">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('{0} megtekintése', __('Club')) ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="card mb-3 clubs">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">
            <div class="col">
                <h3 class="card-title mb-0"><?= h($club->name) ?></h3>
            </div>
            <div class="col-12 col-md-auto ms-md-auto">
                <div class="btn-list">
                    <?= $this->KvForm->actionEdit(['action' => 'edit', $club->id]) ?>
                    <?= $this->KvForm->actionDelete(['action' => 'delete', $club->id], (string)($club->name ?? '')) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-sm table-bordered-vertical">
            <tbody>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('City') ?></th>
                    <td><?= $club->hasValue('city') ? $this->Html->link(h($club->city->name), ['controller' => 'Cities', 'action' => 'view', $club->city->id], ['class' => 'text-reset text-decoration-none fw-bold']) : '' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Clubpresident Id') ?></th>
                    <td><?= h($club->clubpresident_id) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Name') ?></th>
                    <td><?= h($club->name) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Short Name') ?></th>
                    <td><?= h($club->short_name) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Logo') ?></th>
                    <td><?= h($club->logo) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Email') ?></th>
                    <td><?= h($club->email) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Address') ?></th>
                    <td><?= h($club->address) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Phone') ?></th>
                    <td><?= h($club->phone) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Web') ?></th>
                    <td><?= h($club->web) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Facebook') ?></th>
                    <td><?= h($club->facebook) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Insta') ?></th>
                    <td><?= h($club->insta) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($club->id) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('User Count') ?></th>
                    <td><?= $this->Number->format($club->user_count) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Competition Count') ?></th>
                    <td><?= $this->Number->format($club->competition_count) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($club->pos) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('National Membership Fee Date') ?></th>
                    <td><?= h($club->national_membership_fee_date) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Created') ?></th>
                    <td><?= h($club->created) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Modified') ?></th>
                    <td><?= h($club->modified) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Enabled') ?></th>
                    <td><?= $club->enabled ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Visible') ?></th>
                    <td><?= $club->visible ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
$hasRelatedRecords = false;
?>
<?php if (!empty($club->subclubs)) { $hasRelatedRecords = true; } ?>
<?php if (!empty($club->users)) { $hasRelatedRecords = true; } ?>
<?php if ($hasRelatedRecords): ?>
<div class="card">
    <div class="card-header">
        <?php $isFirstRelatedTab = true; ?>
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
            <?php if (!empty($club->subclubs)): ?>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link<?= $isFirstRelatedTab ? ' active' : '' ?>"
                    data-bs-toggle="tab"
                    data-bs-target="#related-subclubs"
                    type="button"
                    role="tab"
                >
                    <?= __('Subclubs') ?>
                </button>
            </li>
            <?php $isFirstRelatedTab = false; ?>
            <?php endif; ?>
            <?php if (!empty($club->users)): ?>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link<?= $isFirstRelatedTab ? ' active' : '' ?>"
                    data-bs-toggle="tab"
                    data-bs-target="#related-users"
                    type="button"
                    role="tab"
                >
                    <?= __('Users') ?>
                </button>
            </li>
            <?php $isFirstRelatedTab = false; ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="card-body tab-content">
        <?php $isFirstRelatedPane = true; ?>
        <?php if (!empty($club->subclubs)): ?>
        <div class="tab-pane<?= $isFirstRelatedPane ? ' active show' : '' ?>" id="related-subclubs" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
                    <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Competition Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions w-1"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($club->subclubs as $subclub): ?>
                        <tr data-edit-url="<?= $this->Url->build(['controller' => 'Subclubs', 'action' => 'edit', $subclub->id]) ?>">
                            <td><?= h($subclub->id) ?></td>
                            <td><?= h($subclub->competition_id) ?></td>
                            <td><?= h($subclub->name) ?></td>
                            <td><?= h($subclub->visible) ?></td>
                            <td><?= h($subclub->pos) ?></td>
                            <td><?= h($subclub->created) ?></td>
                            <td><?= h($subclub->modified) ?></td>
                            <td class="actions">
                                <div class="btn-list flex-nowrap align-items-center">
                                    <?= $this->KvForm->actionView(['controller' => 'Subclubs', 'action' => 'view', $subclub->id], ['title' => __('View')]) ?>
                                    <?= $this->KvForm->actionEdit(['controller' => 'Subclubs', 'action' => 'edit', $subclub->id], ['title' => __('Edit')]) ?>
                                    <?= $this->KvForm->actionDelete(['controller' => 'Subclubs', 'action' => 'delete', $subclub->id], (string)($subclub->id)) ?>
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
        <?php if (!empty($club->users)): ?>
        <div class="tab-pane<?= $isFirstRelatedPane ? ' active show' : '' ?>" id="related-users" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
                    <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('City Id') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Avatar') ?></th>
                            <th><?= __('Token') ?></th>
                            <th><?= __('Token Expires') ?></th>
                            <th><?= __('Api Token') ?></th>
                            <th><?= __('Activation Date') ?></th>
                            <th><?= __('Secret') ?></th>
                            <th><?= __('Secret Verified') ?></th>
                            <th><?= __('Tos Date') ?></th>
                            <th><?= __('Active') ?></th>
                            <th><?= __('Enabled') ?></th>
                            <th><?= __('Is Superuser') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Membership Status') ?></th>
                            <th><?= __('Membership Joined Date') ?></th>
                            <th><?= __('Club Membership Fee Date') ?></th>
                            <th><?= __('National Membership Fee Date') ?></th>
                            <th><?= __('Application Notified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Additional Data') ?></th>
                            <th><?= __('Last Login') ?></th>
                            <th><?= __('Lockout Time') ?></th>
                            <th><?= __('Login Token') ?></th>
                            <th><?= __('Login Token Date') ?></th>
                            <th><?= __('Token Send Requested') ?></th>
                            <th class="actions w-1"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($club->users as $user): ?>
                        <tr data-edit-url="<?= $this->Url->build(['controller' => 'Users', 'action' => 'edit', $user->id]) ?>">
                            <td><?= h($user->id) ?></td>
                            <td><?= h($user->city_id) ?></td>
                            <td><?= h($user->username) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= h($user->password) ?></td>
                            <td><?= h($user->first_name) ?></td>
                            <td><?= h($user->last_name) ?></td>
                            <td><?= h($user->phone) ?></td>
                            <td><?= h($user->avatar) ?></td>
                            <td><?= h($user->token) ?></td>
                            <td><?= h($user->token_expires) ?></td>
                            <td><?= h($user->api_token) ?></td>
                            <td><?= h($user->activation_date) ?></td>
                            <td><?= h($user->secret) ?></td>
                            <td><?= h($user->secret_verified) ?></td>
                            <td><?= h($user->tos_date) ?></td>
                            <td><?= h($user->active) ?></td>
                            <td><?= h($user->enabled) ?></td>
                            <td><?= h($user->is_superuser) ?></td>
                            <td><?= h($user->role) ?></td>
                            <td><?= h($user->membership_status) ?></td>
                            <td><?= h($user->membership_joined_date) ?></td>
                            <td><?= h($user->club_membership_fee_date) ?></td>
                            <td><?= h($user->national_membership_fee_date) ?></td>
                            <td><?= h($user->application_notified) ?></td>
                            <td><?= h($user->created) ?></td>
                            <td><?= h($user->modified) ?></td>
                            <td><?= h($user->additional_data) ?></td>
                            <td><?= h($user->last_login) ?></td>
                            <td><?= h($user->lockout_time) ?></td>
                            <td><?= h($user->login_token) ?></td>
                            <td><?= h($user->login_token_date) ?></td>
                            <td><?= h($user->token_send_requested) ?></td>
                            <td class="actions">
                                <div class="btn-list flex-nowrap align-items-center">
                                    <?= $this->KvForm->actionView(['controller' => 'Users', 'action' => 'view', $user->id], ['title' => __('View')]) ?>
                                    <?= $this->KvForm->actionEdit(['controller' => 'Users', 'action' => 'edit', $user->id], ['title' => __('Edit')]) ?>
                                    <?= $this->KvForm->actionDelete(['controller' => 'Users', 'action' => 'delete', $user->id], (string)($user->id)) ?>
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