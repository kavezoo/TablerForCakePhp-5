<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competition $competition
 */
?>
<div class="page-header d-print-none mb-3 competitions">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('{0} megtekintése', __('Competition')) ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="card mb-3 competitions">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">
            <div class="col">
                <h3 class="card-title mb-0"><?= h($competition->title) ?></h3>
            </div>
            <div class="col-12 col-md-auto ms-md-auto">
                <div class="btn-list">
                    <?= $this->KvForm->actionEdit(['action' => 'edit', $competition->id]) ?>
                    <?= $this->KvForm->actionDelete(['action' => 'delete', $competition->id], (string)($competition->title ?? '')) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-sm table-bordered-vertical">
            <tbody>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Id') ?></th>
                    <td><?= h($competition->id) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('City') ?></th>
                    <td><?= $competition->hasValue('city') ? $this->Html->link(h($competition->city->name), ['controller' => 'Cities', 'action' => 'view', $competition->city->id], ['class' => 'text-reset text-decoration-none fw-bold']) : '' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Venue Name') ?></th>
                    <td><?= h($competition->venue_name) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Venue Address') ?></th>
                    <td><?= h($competition->venue_address) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Google Maps Url') ?></th>
                    <td><?= h($competition->google_maps_url) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Modified By') ?></th>
                    <td><?= h($competition->modified_by) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Name') ?></th>
                    <td><?= h($competition->name) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Title') ?></th>
                    <td><?= h($competition->title) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Subtitle') ?></th>
                    <td><?= h($competition->subtitle) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Subtitle2') ?></th>
                    <td><?= h($competition->subtitle2) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 1 Title') ?></th>
                    <td><?= h($competition->racing_pipe_1_title) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 2 Title') ?></th>
                    <td><?= h($competition->racing_pipe_2_title) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 3 Title') ?></th>
                    <td><?= h($competition->racing_pipe_3_title) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Pipe Type') ?></th>
                    <td><?= h($competition->pipe_type) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Pipe Parameters') ?></th>
                    <td><?= h($competition->pipe_parameters) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Tobacco Type') ?></th>
                    <td><?= h($competition->tobacco_type) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Currency') ?></th>
                    <td><?= h($competition->currency) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Lunch Description') ?></th>
                    <td><?= h($competition->lunch_description) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 1 Image') ?></th>
                    <td><?= h($competition->racing_pipe_1_image) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 2 Image') ?></th>
                    <td><?= h($competition->racing_pipe_2_image) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 3 Image') ?></th>
                    <td><?= h($competition->racing_pipe_3_image) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Organizing Club Id') ?></th>
                    <td><?= $this->Number->format($competition->organizing_club_id) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Competition Text Template Id') ?></th>
                    <td><?= $competition->competition_text_template_id === null ? '' : $this->Number->format($competition->competition_text_template_id) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Minimum Team Size') ?></th>
                    <td><?= $this->Number->format($competition->minimum_team_size) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Lunch For The Attendant') ?></th>
                    <td><?= $this->Number->format($competition->lunch_for_the_attendant) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Tobacco Weight') ?></th>
                    <td><?= $this->Number->format($competition->tobacco_weight) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Entry Fee Member') ?></th>
                    <td><?= $this->Number->format($competition->entry_fee_member) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Entry Fee Non Member') ?></th>
                    <td><?= $this->Number->format($competition->entry_fee_non_member) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Lunch Price') ?></th>
                    <td><?= $this->Number->format($competition->lunch_price) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 1 Price Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_1_price_member) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 1 Price Non Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_1_price_non_member) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 2 Price Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_2_price_member) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 2 Price Non Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_2_price_non_member) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 3 Price Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_3_price_member) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Racing Pipe 3 Price Non Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_3_price_non_member) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('User Count') ?></th>
                    <td><?= $competition->user_count === null ? '' : $this->Number->format($competition->user_count) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('National Pipe Club Member Count') ?></th>
                    <td><?= $competition->national_pipe_club_member_count === null ? '' : $this->Number->format($competition->national_pipe_club_member_count) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Attendant Count') ?></th>
                    <td><?= $competition->attendant_count === null ? '' : $this->Number->format($competition->attendant_count) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($competition->pos) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('First Date Of Application') ?></th>
                    <td><?= h($competition->first_date_of_application) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Application Deadline') ?></th>
                    <td><?= h($competition->application_deadline) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Competition Datetime') ?></th>
                    <td><?= h($competition->competition_datetime) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Start Datetime') ?></th>
                    <td><?= h($competition->start_datetime) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('End Datetime') ?></th>
                    <td><?= h($competition->end_datetime) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Created') ?></th>
                    <td><?= h($competition->created) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Modified') ?></th>
                    <td><?= h($competition->modified) ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('National Competition') ?></th>
                    <td><?= $competition->national_competition ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
                <tr>
                    <th class="w-1 text-nowrap"><?= __('Visible') ?></th>
                    <td><?= $competition->visible ? '<span class=\"badge bg-green-lt\">' . __('Igen') . '</span>' : '<span class=\"badge bg-secondary-lt\">' . __('Nem') . '</span>' ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <h4 class="m-0 mb-2"><?= __('Description') ?></h4>
            <div class="text-secondary"><?= $this->Text->autoParagraph(h($competition->description)); ?></div>
        </div>
    </div>
</div>

<?php
$hasRelatedRecords = false;
?>
<?php if (!empty($competition->users)) { $hasRelatedRecords = true; } ?>
<?php if (!empty($competition->staffs)) { $hasRelatedRecords = true; } ?>
<?php if (!empty($competition->subclubs)) { $hasRelatedRecords = true; } ?>
<?php if ($hasRelatedRecords): ?>
<div class="card">
    <div class="card-header">
        <?php $isFirstRelatedTab = true; ?>
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
            <?php if (!empty($competition->users)): ?>
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
            <?php if (!empty($competition->staffs)): ?>
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
            <?php if (!empty($competition->subclubs)): ?>
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
        </ul>
    </div>
    <div class="card-body tab-content">
        <?php $isFirstRelatedPane = true; ?>
        <?php if (!empty($competition->users)): ?>
        <div class="tab-pane<?= $isFirstRelatedPane ? ' active show' : '' ?>" id="related-users" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
                    <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('City Id') ?></th>
                            <th><?= __('Club Id') ?></th>
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
                        <?php foreach ($competition->users as $user): ?>
                        <tr>
                            <td><?= h($user->id) ?></td>
                            <td><?= h($user->city_id) ?></td>
                            <td><?= h($user->club_id) ?></td>
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
                                    <?= $this->KvForm->actionView(['action' => 'view', $competition->id], ['title' => __('Parent')]) ?>
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
        <?php if (!empty($competition->staffs)): ?>
        <div class="tab-pane<?= $isFirstRelatedPane ? ' active show' : '' ?>" id="related-staffs" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
                    <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions w-1"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($competition->staffs as $staff): ?>
                        <tr>
                            <td><?= h($staff->id) ?></td>
                            <td><?= h($staff->user_id) ?></td>
                            <td><?= h($staff->role) ?></td>
                            <td><?= h($staff->visible) ?></td>
                            <td><?= h($staff->pos) ?></td>
                            <td><?= h($staff->created) ?></td>
                            <td><?= h($staff->modified) ?></td>
                            <td class="actions">
                                <div class="btn-list flex-nowrap align-items-center">
                                    <?= $this->KvForm->actionView(['action' => 'view', $competition->id], ['title' => __('Parent')]) ?>
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
        <?php if (!empty($competition->subclubs)): ?>
        <div class="tab-pane<?= $isFirstRelatedPane ? ' active show' : '' ?>" id="related-subclubs" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
                    <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Club Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions w-1"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($competition->subclubs as $subclub): ?>
                        <tr>
                            <td><?= h($subclub->id) ?></td>
                            <td><?= h($subclub->club_id) ?></td>
                            <td><?= h($subclub->name) ?></td>
                            <td><?= h($subclub->visible) ?></td>
                            <td><?= h($subclub->pos) ?></td>
                            <td><?= h($subclub->created) ?></td>
                            <td><?= h($subclub->modified) ?></td>
                            <td class="actions">
                                <div class="btn-list flex-nowrap align-items-center">
                                    <?= $this->KvForm->actionView(['action' => 'view', $competition->id], ['title' => __('Parent')]) ?>
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
    </div>
</div>
<?php endif; ?>

<?= $this->element('KvAdmin.modal-delete') ?>