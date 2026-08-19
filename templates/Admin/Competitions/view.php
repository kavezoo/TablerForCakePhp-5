<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competition $competition
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Competition'), ['action' => 'edit', $competition->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Competition'), ['action' => 'delete', $competition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $competition->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Competitions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Competition'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="competitions view content">
            <h3><?= h($competition->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($competition->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('City') ?></th>
                    <td><?= $competition->hasValue('city') ? $this->Html->link($competition->city->name, ['controller' => 'Cities', 'action' => 'view', $competition->city->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Venue Name') ?></th>
                    <td><?= h($competition->venue_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Venue Address') ?></th>
                    <td><?= h($competition->venue_address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Google Maps Url') ?></th>
                    <td><?= h($competition->google_maps_url) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= h($competition->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($competition->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($competition->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subtitle') ?></th>
                    <td><?= h($competition->subtitle) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subtitle2') ?></th>
                    <td><?= h($competition->subtitle2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 1 Title') ?></th>
                    <td><?= h($competition->racing_pipe_1_title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 2 Title') ?></th>
                    <td><?= h($competition->racing_pipe_2_title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 3 Title') ?></th>
                    <td><?= h($competition->racing_pipe_3_title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pipe Type') ?></th>
                    <td><?= h($competition->pipe_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pipe Parameters') ?></th>
                    <td><?= h($competition->pipe_parameters) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tobacco Type') ?></th>
                    <td><?= h($competition->tobacco_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Currency') ?></th>
                    <td><?= h($competition->currency) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lunch Description') ?></th>
                    <td><?= h($competition->lunch_description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 1 Image') ?></th>
                    <td><?= h($competition->racing_pipe_1_image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 2 Image') ?></th>
                    <td><?= h($competition->racing_pipe_2_image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 3 Image') ?></th>
                    <td><?= h($competition->racing_pipe_3_image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Organizing Club Id') ?></th>
                    <td><?= $this->Number->format($competition->organizing_club_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Competition Text Template Id') ?></th>
                    <td><?= $competition->competition_text_template_id === null ? '' : $this->Number->format($competition->competition_text_template_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Minimum Team Size') ?></th>
                    <td><?= $this->Number->format($competition->minimum_team_size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lunch For The Attendant') ?></th>
                    <td><?= $this->Number->format($competition->lunch_for_the_attendant) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tobacco Weight') ?></th>
                    <td><?= $this->Number->format($competition->tobacco_weight) ?></td>
                </tr>
                <tr>
                    <th><?= __('Entry Fee Member') ?></th>
                    <td><?= $this->Number->format($competition->entry_fee_member) ?></td>
                </tr>
                <tr>
                    <th><?= __('Entry Fee Non Member') ?></th>
                    <td><?= $this->Number->format($competition->entry_fee_non_member) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lunch Price') ?></th>
                    <td><?= $this->Number->format($competition->lunch_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 1 Price Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_1_price_member) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 1 Price Non Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_1_price_non_member) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 2 Price Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_2_price_member) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 2 Price Non Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_2_price_non_member) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 3 Price Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_3_price_member) ?></td>
                </tr>
                <tr>
                    <th><?= __('Racing Pipe 3 Price Non Member') ?></th>
                    <td><?= $this->Number->format($competition->racing_pipe_3_price_non_member) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Count') ?></th>
                    <td><?= $competition->user_count === null ? '' : $this->Number->format($competition->user_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('National Pipe Club Member Count') ?></th>
                    <td><?= $competition->national_pipe_club_member_count === null ? '' : $this->Number->format($competition->national_pipe_club_member_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Attendant Count') ?></th>
                    <td><?= $competition->attendant_count === null ? '' : $this->Number->format($competition->attendant_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($competition->pos) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Date Of Application') ?></th>
                    <td><?= h($competition->first_date_of_application) ?></td>
                </tr>
                <tr>
                    <th><?= __('Application Deadline') ?></th>
                    <td><?= h($competition->application_deadline) ?></td>
                </tr>
                <tr>
                    <th><?= __('Competition Datetime') ?></th>
                    <td><?= h($competition->competition_datetime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Datetime') ?></th>
                    <td><?= h($competition->start_datetime) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Datetime') ?></th>
                    <td><?= h($competition->end_datetime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($competition->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($competition->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('National Competition') ?></th>
                    <td><?= $competition->national_competition ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Visible') ?></th>
                    <td><?= $competition->visible ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($competition->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($competition->users)) : ?>
                <div class="table-responsive">
                    <table>
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
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($competition->users as $user) : ?>
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
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $user->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $user->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Users', 'action' => 'delete', $user->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $user->id),
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
                <?php if (!empty($competition->staffs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($competition->staffs as $staff) : ?>
                        <tr>
                            <td><?= h($staff->id) ?></td>
                            <td><?= h($staff->user_id) ?></td>
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
            <div class="related">
                <h4><?= __('Related Subclubs') ?></h4>
                <?php if (!empty($competition->subclubs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Club Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($competition->subclubs as $subclub) : ?>
                        <tr>
                            <td><?= h($subclub->id) ?></td>
                            <td><?= h($subclub->club_id) ?></td>
                            <td><?= h($subclub->name) ?></td>
                            <td><?= h($subclub->visible) ?></td>
                            <td><?= h($subclub->pos) ?></td>
                            <td><?= h($subclub->created) ?></td>
                            <td><?= h($subclub->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Subclubs', 'action' => 'view', $subclub->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Subclubs', 'action' => 'edit', $subclub->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Subclubs', 'action' => 'delete', $subclub->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $subclub->id),
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