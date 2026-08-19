<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content">
            <h3><?= h($user->first_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('City') ?></th>
                    <td><?= $user->hasValue('city') ? $this->Html->link($user->city->name, ['controller' => 'Cities', 'action' => 'view', $user->city->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Club') ?></th>
                    <td><?= $user->hasValue('club') ? $this->Html->link($user->club->name, ['controller' => 'Clubs', 'action' => 'view', $user->club->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($user->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($user->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($user->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Avatar') ?></th>
                    <td><?= h($user->avatar) ?></td>
                </tr>
                <tr>
                    <th><?= __('Api Token') ?></th>
                    <td><?= h($user->api_token) ?></td>
                </tr>
                <tr>
                    <th><?= __('Secret') ?></th>
                    <td><?= h($user->secret) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($user->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Membership Status') ?></th>
                    <td><?= h($user->membership_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Login Token') ?></th>
                    <td><?= h($user->login_token) ?></td>
                </tr>
                <tr>
                    <th><?= __('Token Expires') ?></th>
                    <td><?= h($user->token_expires) ?></td>
                </tr>
                <tr>
                    <th><?= __('Activation Date') ?></th>
                    <td><?= h($user->activation_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tos Date') ?></th>
                    <td><?= h($user->tos_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Membership Joined Date') ?></th>
                    <td><?= h($user->membership_joined_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Club Membership Fee Date') ?></th>
                    <td><?= h($user->club_membership_fee_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('National Membership Fee Date') ?></th>
                    <td><?= h($user->national_membership_fee_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Login') ?></th>
                    <td><?= h($user->last_login) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lockout Time') ?></th>
                    <td><?= h($user->lockout_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Login Token Date') ?></th>
                    <td><?= h($user->login_token_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Secret Verified') ?></th>
                    <td><?= $user->secret_verified ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $user->active ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Enabled') ?></th>
                    <td><?= $user->enabled ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Superuser') ?></th>
                    <td><?= $user->is_superuser ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Application Notified') ?></th>
                    <td><?= $user->application_notified ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Token Send Requested') ?></th>
                    <td><?= $user->token_send_requested ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Additional Data') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->additional_data)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Competitions') ?></h4>
                <?php if (!empty($user->competitions)) : ?>
                <div class="table-responsive">
                    <table>
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
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->competitions as $competition) : ?>
                        <tr>
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
                                <?= $this->Html->link(__('View'), ['controller' => 'Competitions', 'action' => 'view', $competition->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Competitions', 'action' => 'edit', $competition->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Competitions', 'action' => 'delete', $competition->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $competition->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Failed Password Attempts') ?></h4>
                <?php if (!empty($user->failed_password_attempts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->failed_password_attempts as $failedPasswordAttempt) : ?>
                        <tr>
                            <td><?= h($failedPasswordAttempt->id) ?></td>
                            <td><?= h($failedPasswordAttempt->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'FailedPasswordAttempts', 'action' => 'view', $failedPasswordAttempt->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'FailedPasswordAttempts', 'action' => 'edit', $failedPasswordAttempt->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'FailedPasswordAttempts', 'action' => 'delete', $failedPasswordAttempt->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $failedPasswordAttempt->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Social Accounts') ?></h4>
                <?php if (!empty($user->social_accounts)) : ?>
                <div class="table-responsive">
                    <table>
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
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->social_accounts as $socialAccount) : ?>
                        <tr>
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
                                <?= $this->Html->link(__('View'), ['controller' => 'SocialAccounts', 'action' => 'view', $socialAccount->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'SocialAccounts', 'action' => 'edit', $socialAccount->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'SocialAccounts', 'action' => 'delete', $socialAccount->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $socialAccount->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Staffs') ?></h4>
                <?php if (!empty($user->staffs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Competition Id') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->staffs as $staff) : ?>
                        <tr>
                            <td><?= h($staff->id) ?></td>
                            <td><?= h($staff->competition_id) ?></td>
                            <td><?= h($staff->role) ?></td>
                            <td><?= h($staff->visible) ?></td>
                            <td><?= h($staff->pos) ?></td>
                            <td><?= h($staff->created) ?></td>
                            <td><?= h($staff->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Staffs', 'action' => 'view', $staff->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Staffs', 'action' => 'edit', $staff->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Staffs', 'action' => 'delete', $staff->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $staff->id),
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