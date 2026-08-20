<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Country $country
 */
?>
<div class="page-header d-print-none mb-3 countries">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('{0} megtekintése', __('Country')) ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Country'), ['action' => 'edit', $country->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Country'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Countries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Country'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="countries view content">
            <h3><?= h($country->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Continent') ?></th>
                    <td><?= $country->hasValue('continent') ? $this->Html->link($country->continent->name, ['controller' => 'Continents', 'action' => 'view', $country->continent->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Iso2') ?></th>
                    <td><?= h($country->iso2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($country->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Endonim Name') ?></th>
                    <td><?= h($country->endonim_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Locale') ?></th>
                    <td><?= h($country->locale) ?></td>
                </tr>
                <tr>
                    <th><?= __('Timezone') ?></th>
                    <td><?= h($country->timezone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone Prefix') ?></th>
                    <td><?= h($country->phone_prefix) ?></td>
                </tr>
                <tr>
                    <th><?= __('Logo') ?></th>
                    <td><?= h($country->logo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Currency') ?></th>
                    <td><?= h($country->currency) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($country->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($country->pos) ?></td>
                </tr>
                <tr>
                    <th><?= __('Club Count') ?></th>
                    <td><?= $this->Number->format($country->club_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Setup Count') ?></th>
                    <td><?= $this->Number->format($country->setup_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Count') ?></th>
                    <td><?= $this->Number->format($country->user_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($country->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($country->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Visible') ?></th>
                    <td><?= $country->visible ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Cities') ?></h4>
                <?php if (!empty($country->cities)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('County Id') ?></th>
                            <th><?= __('Shortname') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Zip') ?></th>
                            <th><?= __('Lat') ?></th>
                            <th><?= __('Lng') ?></th>
                            <th><?= __('Lat2') ?></th>
                            <th><?= __('Lng2') ?></th>
                            <th><?= __('Club Count') ?></th>
                            <th><?= __('Datumido') ?></th>
                            <th><?= __('Datum') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Ido') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($country->cities as $city) : ?>
                        <tr>
                            <td><?= h($city->id) ?></td>
                            <td><?= h($city->county_id) ?></td>
                            <td><?= h($city->shortname) ?></td>
                            <td><?= h($city->name) ?></td>
                            <td><?= h($city->zip) ?></td>
                            <td><?= h($city->lat) ?></td>
                            <td><?= h($city->lng) ?></td>
                            <td><?= h($city->lat2) ?></td>
                            <td><?= h($city->lng2) ?></td>
                            <td><?= h($city->club_count) ?></td>
                            <td><?= h($city->datumido) ?></td>
                            <td><?= h($city->datum) ?></td>
                            <td><?= h($city->description) ?></td>
                            <td><?= h($city->ido) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Cities', 'action' => 'view', $city->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Cities', 'action' => 'edit', $city->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Cities', 'action' => 'delete', $city->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $city->id),
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
                <h4><?= __('Related Clubs') ?></h4>
                <?php if (!empty($country->clubs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('City Id') ?></th>
                            <th><?= __('Clubpresident Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Short Name') ?></th>
                            <th><?= __('Logo') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Enabled') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Web') ?></th>
                            <th><?= __('Facebook') ?></th>
                            <th><?= __('Insta') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('User Count') ?></th>
                            <th><?= __('Competition Count') ?></th>
                            <th><?= __('Club President Id') ?></th>
                            <th><?= __('National Membership Fee Date') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($country->clubs as $club) : ?>
                        <tr>
                            <td><?= h($club->id) ?></td>
                            <td><?= h($club->city_id) ?></td>
                            <td><?= h($club->clubpresident_id) ?></td>
                            <td><?= h($club->name) ?></td>
                            <td><?= h($club->short_name) ?></td>
                            <td><?= h($club->logo) ?></td>
                            <td><?= h($club->email) ?></td>
                            <td><?= h($club->enabled) ?></td>
                            <td><?= h($club->address) ?></td>
                            <td><?= h($club->phone) ?></td>
                            <td><?= h($club->web) ?></td>
                            <td><?= h($club->facebook) ?></td>
                            <td><?= h($club->insta) ?></td>
                            <td><?= h($club->visible) ?></td>
                            <td><?= h($club->pos) ?></td>
                            <td><?= h($club->user_count) ?></td>
                            <td><?= h($club->competition_count) ?></td>
                            <td><?= h($club->club_president_id) ?></td>
                            <td><?= h($club->national_membership_fee_date) ?></td>
                            <td><?= h($club->created) ?></td>
                            <td><?= h($club->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Clubs', 'action' => 'view', $club->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Clubs', 'action' => 'edit', $club->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Clubs', 'action' => 'delete', $club->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $club->id),
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
                <h4><?= __('Related Competition Text Templates') ?></h4>
                <?php if (!empty($country->competition_text_templates)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Label') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Enabled') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($country->competition_text_templates as $competitionTextTemplate) : ?>
                        <tr>
                            <td><?= h($competitionTextTemplate->id) ?></td>
                            <td><?= h($competitionTextTemplate->label) ?></td>
                            <td><?= h($competitionTextTemplate->description) ?></td>
                            <td><?= h($competitionTextTemplate->enabled) ?></td>
                            <td><?= h($competitionTextTemplate->visible) ?></td>
                            <td><?= h($competitionTextTemplate->pos) ?></td>
                            <td><?= h($competitionTextTemplate->created) ?></td>
                            <td><?= h($competitionTextTemplate->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'CompetitionTextTemplates', 'action' => 'view', $competitionTextTemplate->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CompetitionTextTemplates', 'action' => 'edit', $competitionTextTemplate->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'CompetitionTextTemplates', 'action' => 'delete', $competitionTextTemplate->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $competitionTextTemplate->id),
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
                <h4><?= __('Related Competitions') ?></h4>
                <?php if (!empty($country->competitions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Club Id') ?></th>
                            <th><?= __('City Id') ?></th>
                            <th><?= __('Venue Name') ?></th>
                            <th><?= __('Venue Address') ?></th>
                            <th><?= __('Google Maps Url') ?></th>
                            <th><?= __('Competition Text Template Id') ?></th>
                            <th><?= __('User Id') ?></th>
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
                        <?php foreach ($country->competitions as $competition) : ?>
                        <tr>
                            <td><?= h($competition->id) ?></td>
                            <td><?= h($competition->club_id) ?></td>
                            <td><?= h($competition->city_id) ?></td>
                            <td><?= h($competition->venue_name) ?></td>
                            <td><?= h($competition->venue_address) ?></td>
                            <td><?= h($competition->google_maps_url) ?></td>
                            <td><?= h($competition->competition_text_template_id) ?></td>
                            <td><?= h($competition->user_id) ?></td>
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
                <h4><?= __('Related Counties') ?></h4>
                <?php if (!empty($country->counties)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Shortname') ?></th>
                            <th><?= __('Capitalcity') ?></th>
                            <th><?= __('Region') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('City Count') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($country->counties as $county) : ?>
                        <tr>
                            <td><?= h($county->id) ?></td>
                            <td><?= h($county->name) ?></td>
                            <td><?= h($county->shortname) ?></td>
                            <td><?= h($county->capitalcity) ?></td>
                            <td><?= h($county->region) ?></td>
                            <td><?= h($county->pos) ?></td>
                            <td><?= h($county->visible) ?></td>
                            <td><?= h($county->city_count) ?></td>
                            <td><?= h($county->created) ?></td>
                            <td><?= h($county->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Counties', 'action' => 'view', $county->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Counties', 'action' => 'edit', $county->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Counties', 'action' => 'delete', $county->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $county->id),
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
                <h4><?= __('Related Country Visibilities') ?></h4>
                <?php if (!empty($country->country_visibilities)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Visible Country Id') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($country->country_visibilities as $countryVisibility) : ?>
                        <tr>
                            <td><?= h($countryVisibility->id) ?></td>
                            <td><?= h($countryVisibility->visible_country_id) ?></td>
                            <td><?= h($countryVisibility->visible) ?></td>
                            <td><?= h($countryVisibility->pos) ?></td>
                            <td><?= h($countryVisibility->created) ?></td>
                            <td><?= h($countryVisibility->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'CountryVisibilities', 'action' => 'view', $countryVisibility->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CountryVisibilities', 'action' => 'edit', $countryVisibility->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'CountryVisibilities', 'action' => 'delete', $countryVisibility->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $countryVisibility->id),
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
                <h4><?= __('Related Email Templates') ?></h4>
                <?php if (!empty($country->email_templates)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Language Id') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Subject') ?></th>
                            <th><?= __('Body Html') ?></th>
                            <th><?= __('Body Text') ?></th>
                            <th><?= __('Enabled') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($country->email_templates as $emailTemplate) : ?>
                        <tr>
                            <td><?= h($emailTemplate->id) ?></td>
                            <td><?= h($emailTemplate->language_id) ?></td>
                            <td><?= h($emailTemplate->slug) ?></td>
                            <td><?= h($emailTemplate->name) ?></td>
                            <td><?= h($emailTemplate->subject) ?></td>
                            <td><?= h($emailTemplate->body_html) ?></td>
                            <td><?= h($emailTemplate->body_text) ?></td>
                            <td><?= h($emailTemplate->enabled) ?></td>
                            <td><?= h($emailTemplate->visible) ?></td>
                            <td><?= h($emailTemplate->pos) ?></td>
                            <td><?= h($emailTemplate->created) ?></td>
                            <td><?= h($emailTemplate->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'EmailTemplates', 'action' => 'view', $emailTemplate->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'EmailTemplates', 'action' => 'edit', $emailTemplate->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'EmailTemplates', 'action' => 'delete', $emailTemplate->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $emailTemplate->id),
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
                <h4><?= __('Related Event Logs') ?></h4>
                <?php if (!empty($country->event_logs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Actor Role') ?></th>
                            <th><?= __('Module') ?></th>
                            <th><?= __('Action') ?></th>
                            <th><?= __('Entity') ?></th>
                            <th><?= __('Entity Id') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Url') ?></th>
                            <th><?= __('Http Method') ?></th>
                            <th><?= __('Ip') ?></th>
                            <th><?= __('User Agent') ?></th>
                            <th><?= __('Request Data') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($country->event_logs as $eventLog) : ?>
                        <tr>
                            <td><?= h($eventLog->id) ?></td>
                            <td><?= h($eventLog->user_id) ?></td>
                            <td><?= h($eventLog->actor_role) ?></td>
                            <td><?= h($eventLog->module) ?></td>
                            <td><?= h($eventLog->action) ?></td>
                            <td><?= h($eventLog->entity) ?></td>
                            <td><?= h($eventLog->entity_id) ?></td>
                            <td><?= h($eventLog->description) ?></td>
                            <td><?= h($eventLog->url) ?></td>
                            <td><?= h($eventLog->http_method) ?></td>
                            <td><?= h($eventLog->ip) ?></td>
                            <td><?= h($eventLog->user_agent) ?></td>
                            <td><?= h($eventLog->request_data) ?></td>
                            <td><?= h($eventLog->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'EventLogs', 'action' => 'view', $eventLog->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'EventLogs', 'action' => 'edit', $eventLog->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'EventLogs', 'action' => 'delete', $eventLog->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $eventLog->id),
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
                <h4><?= __('Related Setups') ?></h4>
                <?php if (!empty($country->setups)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Edit By') ?></th>
                            <th><?= __('Value') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($country->setups as $setup) : ?>
                        <tr>
                            <td><?= h($setup->id) ?></td>
                            <td><?= h($setup->name) ?></td>
                            <td><?= h($setup->slug) ?></td>
                            <td><?= h($setup->type) ?></td>
                            <td><?= h($setup->edit_by) ?></td>
                            <td><?= h($setup->value) ?></td>
                            <td><?= h($setup->visible) ?></td>
                            <td><?= h($setup->pos) ?></td>
                            <td><?= h($setup->created) ?></td>
                            <td><?= h($setup->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Setups', 'action' => 'view', $setup->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Setups', 'action' => 'edit', $setup->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Setups', 'action' => 'delete', $setup->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $setup->id),
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
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($country->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Club Id') ?></th>
                            <th><?= __('Language Id') ?></th>
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
                        <?php foreach ($country->users as $user) : ?>
                        <tr>
                            <td><?= h($user->id) ?></td>
                            <td><?= h($user->club_id) ?></td>
                            <td><?= h($user->language_id) ?></td>
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
        </div>
    </div>
</div>