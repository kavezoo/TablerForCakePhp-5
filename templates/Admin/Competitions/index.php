<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\> $competitions
 * @var int|null $lastViewedId
 * @var int|null $scrollToId
 * @var string|null $search
 */
use Cake\I18n\I18n;

$showId            = false;
$showCounterFields = false;
$showVisible       = false;
$showCreated       = false;
$showModified      = false;
$showPos           = false;

$this->assign('title', __('Competitions'));
$this->element('KvAdmin.pagination_templates');

$lastViewedId = $lastViewedId ?? $session->read('LastViewed.' . $prefix . '.competition_id');
$scrollToId = $scrollToId ?? $session->read('ScrollTo.' . $prefix . '.competition_id') ?? $lastViewedId;

// 🔍 Keresési kiemelő segédfüggvény
$highlight = function (?string $text) use ($search): string {
    if ($text === null || $text === '') {
        return '';
    }

    $escapedText = h($text);
    if (!empty($search)) {
        $cleanSearch = preg_quote(trim($search), '/');
        return preg_replace('/(' . $cleanSearch . ')/iu', '<mark class="search-highlight">$1</mark>', $escapedText);
    }
    return $escapedText;
};
?>

<div class="card">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">

            <!-- Új competition gomb -->
            <div class="col-auto">
                <?= $this->Html->link($this->Icon->outline('plus') . '<span class="d-none d-sm-inline ms-1">' . __('Add new') . ' ' . __('competition') . '</span>', ['controller' => 'Competitions', 'action' => 'add'], ['escape' => false, 'class' => 'btn btn-outline-secondary btn-header-new']) ?>
            </div>

            <!-- Cím és infó blokk -->
            <div class="col">
                <h3 class="card-title mb-0"><?= __('Competitions') ?></h3>
                <p class="text-secondary m-0"><?= __('Edit line double click on the line') ?></p>
            </div>

            <!-- Kereső űrlap -->
            <div class="col-12 col-md-auto ms-md-auto">
                <?= $this->KvForm->search('search', ['controller' => 'Competitions', 'action' => 'index', '?' => ['clear' => 'search']]) ?>
            </div>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
            <thead>
                <tr>
<?php if (isset($showId) && $showId): ?>
                    <th class="string id"><?= $this->Paginator->sort('id', '#') ?></th>
<?php endif; ?>
					<th class="integer organizing_club_id"><?= $this->Paginator->sort('organizing_club_id') ?></th>					
					<th class="string city_id"><?= $this->Paginator->sort('city_id') ?></th>					
					<th class="string venue_name"><?= $this->Paginator->sort('venue_name') ?></th>					
					<th class="string venue_address"><?= $this->Paginator->sort('venue_address') ?></th>					
					<th class="string google_maps_url"><?= $this->Paginator->sort('google_maps_url') ?></th>					
					<th class="integer competition_text_template_id"><?= $this->Paginator->sort('competition_text_template_id') ?></th>					
					<th class="uuid modified_by"><?= $this->Paginator->sort('modified_by') ?></th>					
					<th class="boolean national_competition"><?= $this->Paginator->sort('national_competition') ?></th>					
					<th class="string name"><?= $this->Paginator->sort('name') ?></th>					
					<th class="string title"><?= $this->Paginator->sort('title') ?></th>					
					<th class="string subtitle"><?= $this->Paginator->sort('subtitle') ?></th>					
					<th class="string subtitle2"><?= $this->Paginator->sort('subtitle2') ?></th>					
					<th class="date first_date_of_application"><?= $this->Paginator->sort('first_date_of_application') ?></th>					
					<th class="date application_deadline"><?= $this->Paginator->sort('application_deadline') ?></th>					
					<th class="datetime competition_datetime"><?= $this->Paginator->sort('competition_datetime') ?></th>					
					<th class="datetime start_datetime"><?= $this->Paginator->sort('start_datetime') ?></th>					
					<th class="datetime end_datetime"><?= $this->Paginator->sort('end_datetime') ?></th>					
					<th class="integer minimum_team_size"><?= $this->Paginator->sort('minimum_team_size') ?></th>					
					<th class="integer lunch_for_the_attendant"><?= $this->Paginator->sort('lunch_for_the_attendant') ?></th>					
					<th class="string racing_pipe_1_title"><?= $this->Paginator->sort('racing_pipe_1_title') ?></th>					
					<th class="string racing_pipe_2_title"><?= $this->Paginator->sort('racing_pipe_2_title') ?></th>					
					<th class="string racing_pipe_3_title"><?= $this->Paginator->sort('racing_pipe_3_title') ?></th>					
					<th class="string pipe_type"><?= $this->Paginator->sort('pipe_type') ?></th>					
					<th class="string pipe_parameters"><?= $this->Paginator->sort('pipe_parameters') ?></th>					
					<th class="string tobacco_type"><?= $this->Paginator->sort('tobacco_type') ?></th>					
					<th class="decimal tobacco_weight"><?= $this->Paginator->sort('tobacco_weight') ?></th>					
					<th class="string currency"><?= $this->Paginator->sort('currency') ?></th>					
					<th class="decimal entry_fee_member"><?= $this->Paginator->sort('entry_fee_member') ?></th>					
					<th class="decimal entry_fee_non_member"><?= $this->Paginator->sort('entry_fee_non_member') ?></th>					
					<th class="string lunch_description"><?= $this->Paginator->sort('lunch_description') ?></th>					
					<th class="decimal lunch_price"><?= $this->Paginator->sort('lunch_price') ?></th>					
					<th class="decimal racing_pipe_1_price_member"><?= $this->Paginator->sort('racing_pipe_1_price_member') ?></th>					
					<th class="decimal racing_pipe_1_price_non_member"><?= $this->Paginator->sort('racing_pipe_1_price_non_member') ?></th>					
					<th class="decimal racing_pipe_2_price_member"><?= $this->Paginator->sort('racing_pipe_2_price_member') ?></th>					
					<th class="decimal racing_pipe_2_price_non_member"><?= $this->Paginator->sort('racing_pipe_2_price_non_member') ?></th>					
					<th class="decimal racing_pipe_3_price_member"><?= $this->Paginator->sort('racing_pipe_3_price_member') ?></th>					
					<th class="decimal racing_pipe_3_price_non_member"><?= $this->Paginator->sort('racing_pipe_3_price_non_member') ?></th>					
					<th class="string racing_pipe_1_image"><?= $this->Paginator->sort('racing_pipe_1_image') ?></th>					
					<th class="string racing_pipe_2_image"><?= $this->Paginator->sort('racing_pipe_2_image') ?></th>					
					<th class="string racing_pipe_3_image"><?= $this->Paginator->sort('racing_pipe_3_image') ?></th>					
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <th class="integer user_count"><?= $this->Paginator->sort('user_count') ?></th>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <th class="integer national_pipe_club_member_count"><?= $this->Paginator->sort('national_pipe_club_member_count') ?></th>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <th class="integer attendant_count"><?= $this->Paginator->sort('attendant_count') ?></th>
<?php endif; ?>
<?php if (isset($showVisible) && $showVisible): ?>
                    <th class="boolean visible"><?= $this->Paginator->sort('visible', __('Visible')) ?></th>
<?php endif; ?>
<?php if (isset($showPos) && $showPos): ?>
                    <th class="integer pos"><?= $this->Paginator->sort('pos', __('Pos')) ?></th>
<?php endif; ?>
<?php if ((isset($showCreated) && $showCreated) || (isset($showModified) && $showModified)): ?>
                    <th class="datetime">
<?php if (isset($showCreated) && $showCreated): ?>
                        <?= $this->Paginator->sort('created', __('Létrehozva')) ?>
<?php endif; ?>
<?php if ((isset($showCreated) && $showCreated) && (isset($showModified) && $showModified)): ?>
                        <br>
<?php endif; ?>
<?php if (isset($showModified) && $showModified): ?>
                        <?= $this->Paginator->sort('modified', __('Módosítva')) ?>
<?php endif; ?>
                    </th>
<?php endif; ?>
                    <th class="actions w-1"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($competitions) && count($competitions) > 0): ?>
                <?php foreach ($competitions as $competition): ?>
                <?php $isLastViewed = (!empty($lastViewedId) && $lastViewedId == $competition->id); ?>
                <tr
                    id="row-<?= (int)$competition->id ?>"
                    class="<?= $isLastViewed ? 'last-viewed' : '' ?>"
                    data-edit-url="<?= $this->Url->build(['action' => 'edit', $competition->id]) ?>"
                >
<?php if (isset($showId) && $showId): ?>
                    <td class="string id"><?= h($competition->id) ?></td>
<?php endif; ?>
                    <td class="integer organizing_club_id text-end"><?= $competition->organizing_club_id === null ? '' : $this->Number->format($competition->organizing_club_id) ?></td>
                    <td class="string city_id">
						<?= $competition->hasValue('city') ? $this->Html->link(
							h($competition->city->name) . '<span class="icon-link-subtle ms-1">' . $this->Icon->outline('link') . '</span>',
							['controller' => 'Cities', 'action' => 'view', $competition->city->id],
							[
								'class' => 'text-reset text-decoration-none fw-bold',
								'escape' => false,
								'data-bs-toggle' => 'tooltip',
								'data-bs-html' => 'true',
								'data-bs-placement' => 'top',
								'title' => '<b>' . h($competition->city->name) . '</b><br>' . __('adatlap megtekintése'),
							]
						) : '' ?>
						
					</td>
                    <td class="string venue_name"><?= $highlight($competition->venue_name) ?></td>
                    <td class="string venue_address"><?= $highlight($competition->venue_address) ?></td>
                    <td class="string google_maps_url"><?= $highlight($competition->google_maps_url) ?></td>
                    <td class="integer competition_text_template_id text-end"><?= $competition->competition_text_template_id === null ? '' : $this->Number->format($competition->competition_text_template_id) ?></td>
                    <td class="uuid modified_by"><?= $highlight($competition->modified_by) ?></td>
                    <td class="boolean national_competition"><?= $competition->national_competition ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
                    <td class="string name"><?= $highlight($competition->name) ?></td>
                    <td class="string title"><?= $highlight($competition->title) ?></td>
                    <td class="string subtitle"><?= $highlight($competition->subtitle) ?></td>
                    <td class="string subtitle2"><?= $highlight($competition->subtitle2) ?></td>
                    <td class="date text-nowrap"><?= h($competition->first_date_of_application?->format('Y-m-d')) ?></td>
                    <td class="date text-nowrap"><?= h($competition->application_deadline?->format('Y-m-d')) ?></td>
                    <td class="datetime text-nowrap"><?= h($competition->competition_datetime?->format('Y-m-d H:i')) ?></td>
                    <td class="datetime text-nowrap"><?= h($competition->start_datetime?->format('Y-m-d H:i')) ?></td>
                    <td class="datetime text-nowrap"><?= h($competition->end_datetime?->format('Y-m-d H:i')) ?></td>
                    <td class="integer minimum_team_size text-end"><?= $competition->minimum_team_size === null ? '' : $this->Number->format($competition->minimum_team_size) ?></td>
                    <td class="integer lunch_for_the_attendant text-end"><?= $competition->lunch_for_the_attendant === null ? '' : $this->Number->format($competition->lunch_for_the_attendant) ?></td>
                    <td class="string racing_pipe_1_title"><?= $highlight($competition->racing_pipe_1_title) ?></td>
                    <td class="string racing_pipe_2_title"><?= $highlight($competition->racing_pipe_2_title) ?></td>
                    <td class="string racing_pipe_3_title"><?= $highlight($competition->racing_pipe_3_title) ?></td>
                    <td class="string pipe_type"><?= $highlight($competition->pipe_type) ?></td>
                    <td class="string pipe_parameters"><?= $highlight($competition->pipe_parameters) ?></td>
                    <td class="string tobacco_type"><?= $highlight($competition->tobacco_type) ?></td>
                    <td class="decimal tobacco_weight text-end"><?= $competition->tobacco_weight === null ? '' : $this->Number->format($competition->tobacco_weight) ?></td>
                    <td class="string currency"><?= $highlight($competition->currency) ?></td>
                    <td class="decimal entry_fee_member text-end"><?= $competition->entry_fee_member === null ? '' : $this->Number->format($competition->entry_fee_member) ?></td>
                    <td class="decimal entry_fee_non_member text-end"><?= $competition->entry_fee_non_member === null ? '' : $this->Number->format($competition->entry_fee_non_member) ?></td>
                    <td class="string lunch_description"><?= $highlight($competition->lunch_description) ?></td>
                    <td class="decimal lunch_price text-end"><?= $competition->lunch_price === null ? '' : $this->Number->format($competition->lunch_price) ?></td>
                    <td class="decimal racing_pipe_1_price_member text-end"><?= $competition->racing_pipe_1_price_member === null ? '' : $this->Number->format($competition->racing_pipe_1_price_member) ?></td>
                    <td class="decimal racing_pipe_1_price_non_member text-end"><?= $competition->racing_pipe_1_price_non_member === null ? '' : $this->Number->format($competition->racing_pipe_1_price_non_member) ?></td>
                    <td class="decimal racing_pipe_2_price_member text-end"><?= $competition->racing_pipe_2_price_member === null ? '' : $this->Number->format($competition->racing_pipe_2_price_member) ?></td>
                    <td class="decimal racing_pipe_2_price_non_member text-end"><?= $competition->racing_pipe_2_price_non_member === null ? '' : $this->Number->format($competition->racing_pipe_2_price_non_member) ?></td>
                    <td class="decimal racing_pipe_3_price_member text-end"><?= $competition->racing_pipe_3_price_member === null ? '' : $this->Number->format($competition->racing_pipe_3_price_member) ?></td>
                    <td class="decimal racing_pipe_3_price_non_member text-end"><?= $competition->racing_pipe_3_price_non_member === null ? '' : $this->Number->format($competition->racing_pipe_3_price_non_member) ?></td>
                    <td class="string racing_pipe_1_image"><?= $highlight($competition->racing_pipe_1_image) ?></td>
                    <td class="string racing_pipe_2_image"><?= $highlight($competition->racing_pipe_2_image) ?></td>
                    <td class="string racing_pipe_3_image"><?= $highlight($competition->racing_pipe_3_image) ?></td>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <td class="integer user_count text-end"><?= $this->Number->format($competition->user_count) ?></td>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <td class="integer national_pipe_club_member_count text-end"><?= $this->Number->format($competition->national_pipe_club_member_count) ?></td>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <td class="integer attendant_count text-end"><?= $this->Number->format($competition->attendant_count) ?></td>
<?php endif; ?>
<?php if (isset($showVisible) && $showVisible): ?>
                    <td class="boolean visible"><?= $competition->visible ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
<?php endif; ?>
<?php if (isset($showPos) && $showPos): ?>
                    <td class="integer pos"><?= h($competition->pos) ?></td>
<?php endif; ?>
<?php if ((isset($showCreated) && $showCreated) || (isset($showModified) && $showModified)): ?>
                    <td class="datetime text-nowrap">
<?php if (isset($showCreated) && $showCreated): ?>
                        <small class="d-block text-muted"><?= h($competition->created?->format('Y-m-d H:i')) ?></small>
<?php endif; ?>
<?php if (isset($showModified) && $showModified): ?>
                        <span><?= h($competition->modified?->format('Y-m-d H:i')) ?></span>
<?php endif; ?>
                    </td>
<?php endif; ?>
                    <td class="actions">
                        <div class="btn-list flex-nowrap align-items-center">
                            <?= $this->KvForm->actionView(['action' => 'view', $competition->id]) ?>
                            <?= $this->KvForm->actionEdit(['action' => 'edit', $competition->id]) ?>
                            <?= $this->KvForm->actionDelete(['action' => 'delete', $competition->id], (string)($competition->title ?? '')) ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="100" class="text-center py-4 text-muted">
                        <?= __('Nincs megjeleníthető adat.') ?>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?= $this->element('KvAdmin.pagination') ?>

</div>

<?= $this->element('KvAdmin.modal-delete') ?>

<?php
/*
 * A kereső gyorsgombok és a sor-duplakattintás minden index oldalon aktív.
 * Ha egy generált nézetben valamelyik JS blokkot ideiglenesen ki szeretnéd kapcsolni,
 * PHP többsoros kommenttel tedd meg a scriptBlock adott részénél.
 */
$this->Html->scriptBlock(
    "
    document.addEventListener('DOMContentLoaded', function () {
        // --- 1. KERESŐ GYORSGOMBOK (Ctrl + K) & INTERAKCIÓK ---
        const searchInput = document.getElementById('advanced-table-search');
        const shortcutHint = document.getElementById('search-shortcut-hint');

        if (searchInput) {
            document.addEventListener('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
                    e.preventDefault();
                    searchInput.focus();
                    searchInput.select();
                }
            });

            if (shortcutHint) {
                searchInput.addEventListener('focus', function () {
                    shortcutHint.innerHTML = 'Enter &crarr;';
                });

                searchInput.addEventListener('blur', function () {
                    shortcutHint.textContent = 'ctrl + K';
                });
            }

            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    this.blur();
                }
            });
        }

        const clearBtn = document.getElementById('btn-clear-search');
        if (clearBtn) {
            clearBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                window.location.href = this.getAttribute('href');
            });
        }

        // --- 2. DUPLA KATTINTÁS SORON: UGRÁS SZERKESZTÉSRE ---
        document.querySelectorAll('.table tbody tr[data-edit-url]').forEach(function (row) {
            row.addEventListener('dblclick', function (e) {
                // Interaktív elemekre dupla kattintva ne navigáljon el.
                if (e.target.closest('a, button, input, select, textarea, label, .actions')) {
                    return;
                }

                const editUrl = row.getAttribute('data-edit-url');
                if (editUrl) {
                    window.location.href = editUrl;
                }
            });
        });

        // --- 3. AUTOMATIKUS FINOM GÖRGETÉS AZ UTOLSÓ REKORDHOZ ---
        " . (!empty($scrollToId) ? "
        let targetRow = document.getElementById('row-" . (int)$scrollToId . "');
        if (!targetRow) {
            targetRow = document.querySelector('.table tr.last-viewed') || document.querySelector('.table tbody tr');
        }

        if (targetRow) {
            const headerOffset = 120;
            const rowPosition = targetRow.getBoundingClientRect().top;
            const offsetPosition = rowPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
        " : "") . "
    });
    ",
    ['block' => 'script']
);
?>