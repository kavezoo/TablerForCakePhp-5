<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="page-header d-print-none mb-3 users">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('{0} megtekintése', __('User')) ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="card mb-3 users">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">
            <div class="col">
                <h3 class="card-title mb-0"><?= h($user->first_name) ?></h3>
            </div>
            <div class="col-12 col-md-auto ms-md-auto">
                <div class="btn-list">
                    <?= $this->KvForm->actionEdit(['action' => 'edit', $user->id]) ?>
                    <?= $this->KvForm->actionDelete(['action' => 'delete', $user->id], (string)($user->first_name ?? '')) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-sm table-bordered-vertical">
            <tbody>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Id') ?></th>
                    <td><?= h($user->id) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('City') ?></th>
                    <td><?= $user->hasValue('city') ? $this->Html->link(h($user->city->name), ['controller' => 'Cities', 'action' => 'view', $user->city->id], ['class' => 'text-reset text-decoration-none fw-bold']) : '' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Club') ?></th>
                    <td><?= $user->hasValue('club') ? $this->Html->link(h($user->club->name), ['controller' => 'Clubs', 'action' => 'view', $user->club->id], ['class' => 'text-reset text-decoration-none fw-bold']) : '' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('First Name') ?></th>
                    <td><?= h($user->first_name) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Last Name') ?></th>
                    <td><?= h($user->last_name) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Phone') ?></th>
                    <td><?= h($user->phone) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Avatar') ?></th>
                    <td><?= h($user->avatar) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Api Token') ?></th>
                    <td><?= h($user->api_token) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Secret') ?></th>
                    <td><?= h($user->secret) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Role') ?></th>
                    <td><?= h($user->role) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Membership Status') ?></th>
                    <td><?= h($user->membership_status) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Login Token') ?></th>
                    <td><?= h($user->login_token) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Token Expires') ?></th>
                    <td><?= h($user->token_expires) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Activation Date') ?></th>
                    <td><?= h($user->activation_date) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Tos Date') ?></th>
                    <td><?= h($user->tos_date) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Membership Joined Date') ?></th>
                    <td><?= h($user->membership_joined_date) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Club Membership Fee Date') ?></th>
                    <td><?= h($user->club_membership_fee_date) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('National Membership Fee Date') ?></th>
                    <td><?= h($user->national_membership_fee_date) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Last Login') ?></th>
                    <td><?= h($user->last_login) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Lockout Time') ?></th>
                    <td><?= h($user->lockout_time) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Login Token Date') ?></th>
                    <td><?= h($user->login_token_date) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Secret Verified') ?></th>
                    <td><?= $user->secret_verified ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Active') ?></th>
                    <td><?= $user->active ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Enabled') ?></th>
                    <td><?= $user->enabled ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Is Superuser') ?></th>
                    <td><?= $user->is_superuser ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Application Notified') ?></th>
                    <td><?= $user->application_notified ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Token Send Requested') ?></th>
                    <td><?= $user->token_send_requested ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <h4 class="m-0 mb-2"><?= __('Additional Data') ?></h4>
            <div class="text-secondary"><?= $this->Text->autoParagraph(h($user->additional_data)); ?></div>
        </div>
    </div>
</div>

<?php
$hasRelatedRecords = false;
?>
<?php if (!empty($user->competitions)) { $hasRelatedRecords = true; } ?>
<?php if (!empty($user->failed_password_attempts)) { $hasRelatedRecords = true; } ?>
<?php if (!empty($user->social_accounts)) { $hasRelatedRecords = true; } ?>
<?php if (!empty($user->staffs)) { $hasRelatedRecords = true; } ?>
<?php if ($hasRelatedRecords): ?>
<div class="card">
    <div class="card-header">
        <?php $isFirstRelatedTab = true; ?>
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
            <?php if (!empty($user->competitions)): ?>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link<?= $isFirstRelatedTab ? ' active' : '' ?>"
                    data-bs-toggle="tab"
                    data-bs-target="#related-competitions"
                    type="button"
                    role="tab"
                >
                    <?= __('Competitions') ?>
                </button>
            </li>
            <?php $isFirstRelatedTab = false; ?>
            <?php endif; ?>
            <?php if (!empty($user->failed_password_attempts)): ?>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link<?= $isFirstRelatedTab ? ' active' : '' ?>"
                    data-bs-toggle="tab"
                    data-bs-target="#related-failed_password_attempts"
                    type="button"
                    role="tab"
                >
                    <?= __('Failed Password Attempts') ?>
                </button>
            </li>
            <?php $isFirstRelatedTab = false; ?>
            <?php endif; ?>
            <?php if (!empty($user->social_accounts)): ?>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link<?= $isFirstRelatedTab ? ' active' : '' ?>"
                    data-bs-toggle="tab"
                    data-bs-target="#related-social_accounts"
                    type="button"
                    role="tab"
                >
                    <?= __('Social Accounts') ?>
                </button>
            </li>
            <?php $isFirstRelatedTab = false; ?>
            <?php endif; ?>
            <?php if (!empty($user->staffs)): ?>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link<?= $isFirstRelatedTab ? ' active' : '' ?>"
                    data-bs-toggle="tab"
                    data-bs-target="#related-staffs"
                    type="button"
                    role="tab"
                >
                    <?= __('Staffs') ?>
                </button>
            </li>
            <?php $isFirstRelatedTab = false; ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="card-body tab-content">
        <?php $isFirstRelatedPane = true; ?>
        <?php if (!empty($user->competitions)): ?>
        <div class="tab-pane<?= $isFirstRelatedPane ? ' active show' : '' ?>" id="related-competitions" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
                    <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Organizing Club Id') ?></th>
                            <th><?= __('City Id') ?></th>
                            <th><?= __('Venue Name') ?></th>
                            <th><?= __('Venue Address') ?></th>
                            <th><?= __('Google Maps Url') ?></th>
                            <th><?= __('Competition Text Template Id') ?></th>
                            <th><?= __('Modified By') ?></th>
                            <th><?= __('National Competition') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Subtitle') ?></th>
                            <th><?= __('Subtitle2') ?></th>
                            <th><?= __('First Date Of Application') ?></th>
                            <th><?= __('Application Deadline') ?></th>
                            <th><?= __('Competition Datetime') ?></th>
                            <th><?= __('Start Datetime') ?></th>
                            <th><?= __('End Datetime') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Minimum Team Size') ?></th>
                            <th><?= __('Lunch For The Attendant') ?></th>
                            <th><?= __('Racing Pipe 1 Title') ?></th>
                            <th><?= __('Racing Pipe 2 Title') ?></th>
                            <th><?= __('Racing Pipe 3 Title') ?></th>
                            <th><?= __('Pipe Type') ?></th>
                            <th><?= __('Pipe Parameters') ?></th>
                            <th><?= __('Tobacco Type') ?></th>
                            <th><?= __('Tobacco Weight') ?></th>
                            <th><?= __('Currency') ?></th>
                            <th><?= __('Entry Fee Member') ?></th>
                            <th><?= __('Entry Fee Non Member') ?></th>
                            <th><?= __('Lunch Description') ?></th>
                            <th><?= __('Lunch Price') ?></th>
                            <th><?= __('Racing Pipe 1 Price Member') ?></th>
                            <th><?= __('Racing Pipe 1 Price Non Member') ?></th>
                            <th><?= __('Racing Pipe 2 Price Member') ?></th>
                            <th><?= __('Racing Pipe 2 Price Non Member') ?></th>
                            <th><?= __('Racing Pipe 3 Price Member') ?></th>
                            <th><?= __('Racing Pipe 3 Price Non Member') ?></th>
                            <th><?= __('Racing Pipe 1 Image') ?></th>
                            <th><?= __('Racing Pipe 2 Image') ?></th>
                            <th><?= __('Racing Pipe 3 Image') ?></th>
                            <th><?= __('User Count') ?></th>
                            <th><?= __('National Pipe Club Member Count') ?></th>
                            <th><?= __('Attendant Count') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions w-1"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user->competitions as $competition): ?>
                        <tr data-edit-url="<?= $this->Url->build(['controller' => 'Competitions', 'action' => 'edit', $competition->id]) ?>">
                            <td><?= h($competition->id) ?></td>
                            <td><?= h($competition->organizing_club_id) ?></td>
                            <td><?= h($competition->city_id) ?></td>
                            <td><?= h($competition->venue_name) ?></td>
                            <td><?= h($competition->venue_address) ?></td>
                            <td><?= h($competition->google_maps_url) ?></td>
                            <td><?= h($competition->competition_text_template_id) ?></td>
                            <td><?= h($competition->modified_by) ?></td>
                            <td><?= h($competition->national_competition) ?></td>
                            <td><?= h($competition->name) ?></td>
                            <td><?= h($competition->title) ?></td>
                            <td><?= h($competition->subtitle) ?></td>
                            <td><?= h($competition->subtitle2) ?></td>
                            <td><?= h($competition->first_date_of_application) ?></td>
                            <td><?= h($competition->application_deadline) ?></td>
                            <td><?= h($competition->competition_datetime) ?></td>
                            <td><?= h($competition->start_datetime) ?></td>
                            <td><?= h($competition->end_datetime) ?></td>
                            <td><?= h($competition->description) ?></td>
                            <td><?= h($competition->minimum_team_size) ?></td>
                            <td><?= h($competition->lunch_for_the_attendant) ?></td>
                            <td><?= h($competition->racing_pipe_1_title) ?></td>
                            <td><?= h($competition->racing_pipe_2_title) ?></td>
                            <td><?= h($competition->racing_pipe_3_title) ?></td>
                            <td><?= h($competition->pipe_type) ?></td>
                            <td><?= h($competition->pipe_parameters) ?></td>
                            <td><?= h($competition->tobacco_type) ?></td>
                            <td><?= h($competition->tobacco_weight) ?></td>
                            <td><?= h($competition->currency) ?></td>
                            <td><?= h($competition->entry_fee_member) ?></td>
                            <td><?= h($competition->entry_fee_non_member) ?></td>
                            <td><?= h($competition->lunch_description) ?></td>
                            <td><?= h($competition->lunch_price) ?></td>
                            <td><?= h($competition->racing_pipe_1_price_member) ?></td>
                            <td><?= h($competition->racing_pipe_1_price_non_member) ?></td>
                            <td><?= h($competition->racing_pipe_2_price_member) ?></td>
                            <td><?= h($competition->racing_pipe_2_price_non_member) ?></td>
                            <td><?= h($competition->racing_pipe_3_price_member) ?></td>
                            <td><?= h($competition->racing_pipe_3_price_non_member) ?></td>
                            <td><?= h($competition->racing_pipe_1_image) ?></td>
                            <td><?= h($competition->racing_pipe_2_image) ?></td>
                            <td><?= h($competition->racing_pipe_3_image) ?></td>
                            <td><?= h($competition->user_count) ?></td>
                            <td><?= h($competition->national_pipe_club_member_count) ?></td>
                            <td><?= h($competition->attendant_count) ?></td>
                            <td><?= h($competition->visible) ?></td>
                            <td><?= h($competition->pos) ?></td>
                            <td><?= h($competition->created) ?></td>
                            <td><?= h($competition->modified) ?></td>
                            <td class="actions">
                                <div class="btn-list flex-nowrap align-items-center">
                                    <?= $this->KvForm->actionView(['controller' => 'Competitions', 'action' => 'view', $competition->id], ['title' => __('View')]) ?>
                                    <?= $this->KvForm->actionEdit(['controller' => 'Competitions', 'action' => 'edit', $competition->id], ['title' => __('Edit')]) ?>
                                    <?= $this->KvForm->actionDelete(['controller' => 'Competitions', 'action' => 'delete', $competition->id], (string)($competition->id)) ?>
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
        <?php if (!empty($user->failed_password_attempts)): ?>
        <div class="tab-pane<?= $isFirstRelatedPane ? ' active show' : '' ?>" id="related-failed_password_attempts" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
                    <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions w-1"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user->failed_password_attempts as $failedPasswordAttempt): ?>
                        <tr data-edit-url="<?= $this->Url->build(['controller' => 'FailedPasswordAttempts', 'action' => 'edit', $failedPasswordAttempt->id]) ?>">
                            <td><?= h($failedPasswordAttempt->id) ?></td>
                            <td><?= h($failedPasswordAttempt->created) ?></td>
                            <td class="actions">
                                <div class="btn-list flex-nowrap align-items-center">
                                    <?= $this->KvForm->actionView(['controller' => 'FailedPasswordAttempts', 'action' => 'view', $failedPasswordAttempt->id], ['title' => __('View')]) ?>
                                    <?= $this->KvForm->actionEdit(['controller' => 'FailedPasswordAttempts', 'action' => 'edit', $failedPasswordAttempt->id], ['title' => __('Edit')]) ?>
                                    <?= $this->KvForm->actionDelete(['controller' => 'FailedPasswordAttempts', 'action' => 'delete', $failedPasswordAttempt->id], (string)($failedPasswordAttempt->id)) ?>
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
        <?php if (!empty($user->social_accounts)): ?>
        <div class="tab-pane<?= $isFirstRelatedPane ? ' active show' : '' ?>" id="related-social_accounts" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
                    <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Provider') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Avatar') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Link') ?></th>
                            <th><?= __('Token') ?></th>
                            <th><?= __('Token Secret') ?></th>
                            <th><?= __('Token Expires') ?></th>
                            <th><?= __('Active') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions w-1"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user->social_accounts as $socialAccount): ?>
                        <tr data-edit-url="<?= $this->Url->build(['controller' => 'SocialAccounts', 'action' => 'edit', $socialAccount->id]) ?>">
                            <td><?= h($socialAccount->id) ?></td>
                            <td><?= h($socialAccount->provider) ?></td>
                            <td><?= h($socialAccount->username) ?></td>
                            <td><?= h($socialAccount->reference) ?></td>
                            <td><?= h($socialAccount->avatar) ?></td>
                            <td><?= h($socialAccount->description) ?></td>
                            <td><?= h($socialAccount->link) ?></td>
                            <td><?= h($socialAccount->token) ?></td>
                            <td><?= h($socialAccount->token_secret) ?></td>
                            <td><?= h($socialAccount->token_expires) ?></td>
                            <td><?= h($socialAccount->active) ?></td>
                            <td><?= h($socialAccount->data) ?></td>
                            <td><?= h($socialAccount->created) ?></td>
                            <td><?= h($socialAccount->modified) ?></td>
                            <td class="actions">
                                <div class="btn-list flex-nowrap align-items-center">
                                    <?= $this->KvForm->actionView(['controller' => 'SocialAccounts', 'action' => 'view', $socialAccount->id], ['title' => __('View')]) ?>
                                    <?= $this->KvForm->actionEdit(['controller' => 'SocialAccounts', 'action' => 'edit', $socialAccount->id], ['title' => __('Edit')]) ?>
                                    <?= $this->KvForm->actionDelete(['controller' => 'SocialAccounts', 'action' => 'delete', $socialAccount->id], (string)($socialAccount->id)) ?>
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
        <?php if (!empty($user->staffs)): ?>
        <div class="tab-pane<?= $isFirstRelatedPane ? ' active show' : '' ?>" id="related-staffs" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
                    <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Competition Id') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions w-1"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user->staffs as $staff): ?>
                        <tr data-edit-url="<?= $this->Url->build(['controller' => 'Staffs', 'action' => 'edit', $staff->id]) ?>">
                            <td><?= h($staff->id) ?></td>
                            <td><?= h($staff->competition_id) ?></td>
                            <td><?= h($staff->role) ?></td>
                            <td><?= h($staff->visible) ?></td>
                            <td><?= h($staff->pos) ?></td>
                            <td><?= h($staff->created) ?></td>
                            <td><?= h($staff->modified) ?></td>
                            <td class="actions">
                                <div class="btn-list flex-nowrap align-items-center">
                                    <?= $this->KvForm->actionView(['controller' => 'Staffs', 'action' => 'view', $staff->id], ['title' => __('View')]) ?>
                                    <?= $this->KvForm->actionEdit(['controller' => 'Staffs', 'action' => 'edit', $staff->id], ['title' => __('Edit')]) ?>
                                    <?= $this->KvForm->actionDelete(['controller' => 'Staffs', 'action' => 'delete', $staff->id], (string)($staff->id)) ?>
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