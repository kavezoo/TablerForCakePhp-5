<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\> $competitionsUsers
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

$this->assign('title', __('Competitionsusers'));
$this->element('KvAdmin.pagination_templates');

$lastViewedId = $lastViewedId ?? $session->read('LastViewed.' . $prefix . 'competitionsUser_id');
$scrollToId = $scrollToId ?? $session->read('ScrollTo.' . $prefix . 'competitionsUser_id') ?? $lastViewedId;

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

            <!-- Új competitionsUser gomb -->
            <div class="col-auto">
                <?= $this->Html->link($this->Icon->outline('plus') . '<span class="d-none d-sm-inline ms-1">' . __('Add new') . ' ' . __('competitionsUser') . '</span>', ['controller' => 'Competitionsusers', 'action' => 'add'], ['escape' => false, 'class' => 'btn btn-outline-secondary btn-header-new']) ?>
            </div>

            <!-- Cím és infó blokk -->
            <div class="col">
                <h3 class="card-title mb-0"><?= __('Competitionsusers') ?></h3>
                <p class="text-secondary m-0"><?= __('Edit line double click on the line') ?></p>
            </div>

            <!-- Kereső űrlap -->
            <div class="col-12 col-md-auto ms-md-auto">
                <?= $this->KvForm->search('search', ['controller' => 'Competitionsusers', 'action' => 'index', '?' => ['clear' => 'search']]) ?>
            </div>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
            <thead>
                <tr>
<?php if (isset($showId) && $showId): ?>
                    <th class="integer id"><?= $this->Paginator->sort('id', '#') ?></th>
<?php endif; ?>
					<th class="string user_id"><?= $this->Paginator->sort('user_id') ?></th>					
					<th class="string competition_id"><?= $this->Paginator->sort('competition_id') ?></th>					
					<th class="string subclub_id"><?= $this->Paginator->sort('subclub_id') ?></th>					
					<th class="string status"><?= $this->Paginator->sort('status') ?></th>					
					<th class="integer lunch_for_the_attendant"><?= $this->Paginator->sort('lunch_for_the_attendant') ?></th>					
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <th class="integer companion_count"><?= $this->Paginator->sort('companion_count') ?></th>
<?php endif; ?>
					<th class="string special_lunch"><?= $this->Paginator->sort('special_lunch') ?></th>					
					<th class="integer racing_pipe_1_qty"><?= $this->Paginator->sort('racing_pipe_1_qty') ?></th>					
					<th class="integer racing_pipe_2_qty"><?= $this->Paginator->sort('racing_pipe_2_qty') ?></th>					
					<th class="integer racing_pipe_3_qty"><?= $this->Paginator->sort('racing_pipe_3_qty') ?></th>					
					<th class="string comment"><?= $this->Paginator->sort('comment') ?></th>					
					<th class="datetime fee_paid_at"><?= $this->Paginator->sort('fee_paid_at') ?></th>					
					<th class="uuid fee_paid_by"><?= $this->Paginator->sort('fee_paid_by') ?></th>					
					<th class="decimal entry_fee_amount"><?= $this->Paginator->sort('entry_fee_amount') ?></th>					
					<th class="decimal racing_pipe_1_fee"><?= $this->Paginator->sort('racing_pipe_1_fee') ?></th>					
					<th class="decimal racing_pipe_2_fee"><?= $this->Paginator->sort('racing_pipe_2_fee') ?></th>					
					<th class="decimal racing_pipe_3_fee"><?= $this->Paginator->sort('racing_pipe_3_fee') ?></th>					
					<th class="decimal lunch_fee"><?= $this->Paginator->sort('lunch_fee') ?></th>					
					<th class="decimal fee_total"><?= $this->Paginator->sort('fee_total') ?></th>					
					<th class="decimal result_time"><?= $this->Paginator->sort('result_time') ?></th>					
					<th class="string result_recorded_by_email"><?= $this->Paginator->sort('result_recorded_by_email') ?></th>					
					<th class="integer result_rank"><?= $this->Paginator->sort('result_rank') ?></th>					
					<th class="string result_score"><?= $this->Paginator->sort('result_score') ?></th>					
					<th class="string result_note"><?= $this->Paginator->sort('result_note') ?></th>					
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
                <?php if (!empty($competitionsUsers) && count($competitionsUsers) > 0): ?>
                <?php foreach ($competitionsUsers as $competitionsUser): ?>
                <?php $isLastViewed = (!empty($lastViewedId) && $lastViewedId == $competitionsUser->id); ?>
                <tr
                    id="row-<?= (int)$competitionsUser->id ?>"
                    class="<?= $isLastViewed ? 'last-viewed' : '' ?>"
                    data-edit-url="<?= $this->Url->build(['action' => 'edit', $competitionsUser->id]) ?>"
                >
<?php if (isset($showId) && $showId): ?>
                    <td class="integer id"><?= h($competitionsUser->id) ?></td>
<?php endif; ?>
                    <td class="string user_id">
						<?= $competitionsUser->hasValue('user') ? $this->Html->link(
							h($competitionsUser->user->first_name) . '<span class="icon-link-subtle ms-1">' . $this->Icon->outline('link') . '</span>',
							['controller' => 'Users', 'action' => 'view', $competitionsUser->user->id],
							[
								'class' => 'text-reset text-decoration-none fw-bold',
								'escape' => false,
								'data-bs-toggle' => 'tooltip',
								'data-bs-html' => 'true',
								'data-bs-placement' => 'top',
								'title' => '<b>' . h($competitionsUser->user->first_name) . '</b><br>' . __('adatlap megtekintése'),
							]
						) : '' ?>
						
					</td>
                    <td class="string competition_id">
						<?= $competitionsUser->hasValue('competition') ? $this->Html->link(
							h($competitionsUser->competition->title) . '<span class="icon-link-subtle ms-1">' . $this->Icon->outline('link') . '</span>',
							['controller' => 'Competitions', 'action' => 'view', $competitionsUser->competition->id],
							[
								'class' => 'text-reset text-decoration-none fw-bold',
								'escape' => false,
								'data-bs-toggle' => 'tooltip',
								'data-bs-html' => 'true',
								'data-bs-placement' => 'top',
								'title' => '<b>' . h($competitionsUser->competition->title) . '</b><br>' . __('adatlap megtekintése'),
							]
						) : '' ?>
						
					</td>
                    <td class="string subclub_id">
						<?= $competitionsUser->hasValue('subclub') ? $this->Html->link(
							h($competitionsUser->subclub->name) . '<span class="icon-link-subtle ms-1">' . $this->Icon->outline('link') . '</span>',
							['controller' => 'Subclubs', 'action' => 'view', $competitionsUser->subclub->id],
							[
								'class' => 'text-reset text-decoration-none fw-bold',
								'escape' => false,
								'data-bs-toggle' => 'tooltip',
								'data-bs-html' => 'true',
								'data-bs-placement' => 'top',
								'title' => '<b>' . h($competitionsUser->subclub->name) . '</b><br>' . __('adatlap megtekintése'),
							]
						) : '' ?>
						
					</td>
                    <td class="string status"><?= $highlight($competitionsUser->status) ?></td>
                    <td class="integer lunch_for_the_attendant text-end"><?= $competitionsUser->lunch_for_the_attendant === null ? '' : $this->Number->format($competitionsUser->lunch_for_the_attendant) ?></td>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <td class="integer companion_count text-end"><?= $this->Number->format($competitionsUser->companion_count) ?></td>
<?php endif; ?>
                    <td class="string special_lunch"><?= $highlight($competitionsUser->special_lunch) ?></td>
                    <td class="integer racing_pipe_1_qty text-end"><?= $competitionsUser->racing_pipe_1_qty === null ? '' : $this->Number->format($competitionsUser->racing_pipe_1_qty) ?></td>
                    <td class="integer racing_pipe_2_qty text-end"><?= $competitionsUser->racing_pipe_2_qty === null ? '' : $this->Number->format($competitionsUser->racing_pipe_2_qty) ?></td>
                    <td class="integer racing_pipe_3_qty text-end"><?= $competitionsUser->racing_pipe_3_qty === null ? '' : $this->Number->format($competitionsUser->racing_pipe_3_qty) ?></td>
                    <td class="string comment"><?= $highlight($competitionsUser->comment) ?></td>
                    <td class="datetime text-nowrap"><?= h($competitionsUser->fee_paid_at?->format('Y-m-d H:i')) ?></td>
                    <td class="uuid fee_paid_by"><?= $highlight($competitionsUser->fee_paid_by) ?></td>
                    <td class="decimal entry_fee_amount text-end"><?= $competitionsUser->entry_fee_amount === null ? '' : $this->Number->format($competitionsUser->entry_fee_amount) ?></td>
                    <td class="decimal racing_pipe_1_fee text-end"><?= $competitionsUser->racing_pipe_1_fee === null ? '' : $this->Number->format($competitionsUser->racing_pipe_1_fee) ?></td>
                    <td class="decimal racing_pipe_2_fee text-end"><?= $competitionsUser->racing_pipe_2_fee === null ? '' : $this->Number->format($competitionsUser->racing_pipe_2_fee) ?></td>
                    <td class="decimal racing_pipe_3_fee text-end"><?= $competitionsUser->racing_pipe_3_fee === null ? '' : $this->Number->format($competitionsUser->racing_pipe_3_fee) ?></td>
                    <td class="decimal lunch_fee text-end"><?= $competitionsUser->lunch_fee === null ? '' : $this->Number->format($competitionsUser->lunch_fee) ?></td>
                    <td class="decimal fee_total text-end"><?= $competitionsUser->fee_total === null ? '' : $this->Number->format($competitionsUser->fee_total) ?></td>
                    <td class="decimal result_time text-end"><?= $competitionsUser->result_time === null ? '' : $this->Number->format($competitionsUser->result_time) ?></td>
                    <td class="string result_recorded_by_email"><?= $highlight($competitionsUser->result_recorded_by_email) ?></td>
                    <td class="integer result_rank text-end"><?= $competitionsUser->result_rank === null ? '' : $this->Number->format($competitionsUser->result_rank) ?></td>
                    <td class="string result_score"><?= $highlight($competitionsUser->result_score) ?></td>
                    <td class="string result_note"><?= $highlight($competitionsUser->result_note) ?></td>
<?php if (isset($showVisible) && $showVisible): ?>
                    <td class="boolean visible"><?= $competitionsUser->visible ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
<?php endif; ?>
<?php if (isset($showPos) && $showPos): ?>
                    <td class="integer pos"><?= h($competitionsUser->pos) ?></td>
<?php endif; ?>
<?php if ((isset($showCreated) && $showCreated) || (isset($showModified) && $showModified)): ?>
                    <td class="datetime text-nowrap">
<?php if (isset($showCreated) && $showCreated): ?>
                        <small class="d-block text-muted"><?= h($competitionsUser->created?->format('Y-m-d H:i')) ?></small>
<?php endif; ?>
<?php if (isset($showModified) && $showModified): ?>
                        <span><?= h($competitionsUser->modified?->format('Y-m-d H:i')) ?></span>
<?php endif; ?>
                    </td>
<?php endif; ?>
                    <td class="actions">
                        <div class="btn-list flex-nowrap align-items-center">
                            <?= $this->KvForm->actionView(['action' => 'view', $competitionsUser->id]) ?>
                            <?= $this->KvForm->actionEdit(['action' => 'edit', $competitionsUser->id]) ?>
                            <?= $this->KvForm->actionDelete(['action' => 'delete', $competitionsUser->id], (string)($competitionsUser->user_id ?? '')) ?>
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