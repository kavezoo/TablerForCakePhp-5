<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\> $clubs
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

$this->assign('title', __('Clubs'));
$this->element('KvAdmin.pagination_templates');

$lastViewedId = $lastViewedId ?? $this->getRequest()->getSession()->read('LastViewed.club_id');
$scrollToId = $scrollToId ?? $this->getRequest()->getSession()->read('ScrollTo.club_id') ?? $lastViewedId;

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

            <!-- Új club gomb -->
            <div class="col-auto">
                <?= $this->Html->link($this->Icon->outline('plus') . '<span class="d-none d-sm-inline ms-1">' . __('Add new') . ' ' . __('club') . '</span>', ['controller' => 'Clubs', 'action' => 'add'], ['escape' => false, 'class' => 'btn btn-outline-secondary btn-header-new']) ?>
            </div>

            <!-- Cím és infó blokk -->
            <div class="col">
                <h3 class="card-title mb-0"><?= __('Clubs') ?></h3>
                <p class="text-secondary m-0"><?= __('Double-click on the line') . ' ' . __('edit') ?></p>
            </div>

            <!-- Kereső űrlap -->
            <div class="col-12 col-md-auto ms-md-auto">
                <?= $this->KvForm->search('search', ['controller' => 'Clubs', 'action' => 'index', '?' => ['clear' => 'search']]) ?>
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
					<th class="string city_id"><?= $this->Paginator->sort('city_id') ?></th>					
					<th class="string clubpresident_id"><?= $this->Paginator->sort('clubpresident_id') ?></th>					
					<th class="string name"><?= $this->Paginator->sort('name') ?></th>					
					<th class="string short_name"><?= $this->Paginator->sort('short_name') ?></th>					
					<th class="string logo"><?= $this->Paginator->sort('logo') ?></th>					
					<th class="string email"><?= $this->Paginator->sort('email') ?></th>					
					<th class="boolean enabled"><?= $this->Paginator->sort('enabled') ?></th>					
					<th class="string address"><?= $this->Paginator->sort('address') ?></th>					
					<th class="string phone"><?= $this->Paginator->sort('phone') ?></th>					
					<th class="string web"><?= $this->Paginator->sort('web') ?></th>					
					<th class="string facebook"><?= $this->Paginator->sort('facebook') ?></th>					
					<th class="string insta"><?= $this->Paginator->sort('insta') ?></th>					
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <th class="integer user_count"><?= $this->Paginator->sort('user_count') ?></th>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <th class="integer competition_count"><?= $this->Paginator->sort('competition_count') ?></th>
<?php endif; ?>
					<th class="uuid club_president_id"><?= $this->Paginator->sort('club_president_id') ?></th>					
					<th class="date national_membership_fee_date"><?= $this->Paginator->sort('national_membership_fee_date') ?></th>					
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
                <?php if (!empty($clubs) && count($clubs) > 0): ?>
                <?php foreach ($clubs as $club): ?>
                <?php $isLastViewed = (!empty($lastViewedId) && $lastViewedId == $club->id); ?>
                <tr
                    id="row-<?= (int)$club->id ?>"
                    class="<?= $isLastViewed ? 'last-viewed' : '' ?>"
                    data-edit-url="<?= $this->Url->build(['action' => 'edit', $club->id]) ?>"
                >
<?php if (isset($showId) && $showId): ?>
                    <td class="integer id"><?= h($club->id) ?></td>
<?php endif; ?>
                    <td class="string city_id">
						<?= $club->hasValue('city') ? $this->Html->link(
							h($club->city->name) . '<span class="icon-link-subtle ms-1">' . $this->Icon->outline('link') . '</span>',
							['controller' => 'Cities', 'action' => 'view', $club->city->id],
							[
								'class' => 'text-reset text-decoration-none fw-bold',
								'escape' => false,
								'data-bs-toggle' => 'tooltip',
								'data-bs-html' => 'true',
								'data-bs-placement' => 'top',
								'title' => '<b>' . h($club->city->name) . '</b><br>' . __('adatlap megtekintése'),
							]
						) : '' ?>
						
					</td>
                    <td class="string clubpresident_id"><?= $highlight($club->clubpresident_id) ?></td>
                    <td class="string name"><?= $highlight($club->name) ?></td>
                    <td class="string short_name"><?= $highlight($club->short_name) ?></td>
                    <td class="string logo"><?= $highlight($club->logo) ?></td>
                    <td class="string email"><?= $highlight($club->email) ?></td>
                    <td class="boolean enabled"><?= $club->enabled ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
                    <td class="string address"><?= $highlight($club->address) ?></td>
                    <td class="string phone"><?= $highlight($club->phone) ?></td>
                    <td class="string web"><?= $highlight($club->web) ?></td>
                    <td class="string facebook"><?= $highlight($club->facebook) ?></td>
                    <td class="string insta"><?= $highlight($club->insta) ?></td>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <td class="integer user_count text-end"><?= $this->Number->format($club->user_count) ?></td>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <td class="integer competition_count text-end"><?= $this->Number->format($club->competition_count) ?></td>
<?php endif; ?>
                    <td class="uuid club_president_id"><?= $highlight($club->club_president_id) ?></td>
                    <td class="date text-nowrap"><?= h($club->national_membership_fee_date?->format('Y-m-d')) ?></td>
<?php if (isset($showVisible) && $showVisible): ?>
                    <td class="boolean visible"><?= $club->visible ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
<?php endif; ?>
<?php if (isset($showPos) && $showPos): ?>
                    <td class="integer pos"><?= h($club->pos) ?></td>
<?php endif; ?>
<?php if ((isset($showCreated) && $showCreated) || (isset($showModified) && $showModified)): ?>
                    <td class="datetime text-nowrap">
<?php if (isset($showCreated) && $showCreated): ?>
                        <small class="d-block text-muted"><?= h($club->created?->format('Y-m-d H:i')) ?></small>
<?php endif; ?>
<?php if (isset($showModified) && $showModified): ?>
                        <span><?= h($club->modified?->format('Y-m-d H:i')) ?></span>
<?php endif; ?>
                    </td>
<?php endif; ?>
                    <td class="actions">
                        <div class="btn-list flex-nowrap align-items-center">
                            <?= $this->KvForm->actionView(['action' => 'view', $club->id]) ?>
                            <?= $this->KvForm->actionEdit(['action' => 'edit', $club->id]) ?>
                            <?= $this->KvForm->actionDelete(['action' => 'delete', $club->id], (string)($club->name ?? '')) ?>
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