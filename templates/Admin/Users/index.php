<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\> $users
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

$this->assign('title', __('Users'));
$this->element('KvAdmin.pagination_templates');

$lastViewedId = $lastViewedId ?? $this->getRequest()->getSession()->read('LastViewed.user_id');
$scrollToId = $scrollToId ?? $this->getRequest()->getSession()->read('ScrollTo.user_id') ?? $lastViewedId;

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

            <!-- Új user gomb -->
            <div class="col-auto">
                <?= $this->Html->link($this->Icon->outline('plus') . '<span class="d-none d-sm-inline ms-1">' . __('Add new') . ' ' . __('user') . '</span>', ['controller' => 'Users', 'action' => 'add'], ['escape' => false, 'class' => 'btn btn-outline-secondary btn-header-new']) ?>
            </div>

            <!-- Cím és infó blokk -->
            <div class="col">
                <h3 class="card-title mb-0"><?= __('Users') ?></h3>
                <p class="text-secondary m-0"><?= __('Double-click on the line') . ' ' . __('edit') ?></p>
            </div>

            <!-- Kereső űrlap -->
            <div class="col-12 col-md-auto ms-md-auto">
                <?= $this->KvForm->search('search', ['controller' => 'Users', 'action' => 'index', '?' => ['clear' => 'search']]) ?>
            </div>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
            <thead>
                <tr>
<?php if (isset($showId) && $showId): ?>
                    <th class="uuid id"><?= $this->Paginator->sort('id', '#') ?></th>
<?php endif; ?>
					<th class="string city_id"><?= $this->Paginator->sort('city_id') ?></th>					
					<th class="string club_id"><?= $this->Paginator->sort('club_id') ?></th>					
					<th class="string first_name"><?= $this->Paginator->sort('first_name') ?>&nbsp;<?= $this->Paginator->sort('last_name') ?></th>
					<th class="string email"><?= $this->Paginator->sort('email') ?></th>					
					<th class="string phone"><?= $this->Paginator->sort('phone') ?></th>					
					<th class="boolean active"><?= $this->Paginator->sort('active') ?></th>					
					<th class="boolean enabled"><?= $this->Paginator->sort('enabled') ?></th>					
					<th class="string role"><?= $this->Paginator->sort('role') ?></th>					

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
                <?php if (!empty($users) && count($users) > 0): ?>
                <?php foreach ($users as $user): ?>
                <?php $isLastViewed = (!empty($lastViewedId) && $lastViewedId == $user->id); ?>
                <tr id="row-<?= (int)$user->id ?>" class="<?= $isLastViewed ? 'last-viewed' : '' ?>">
<?php if (isset($showId) && $showId): ?>
                    <td class="uuid id"><?= h($user->id) ?></td>
<?php endif; ?>
                    <td class="string city_id">
						<?= $user->hasValue('city') ? $this->Html->link(
							h($user->city->name) . '<span class="icon-link-subtle ms-1">' . $this->Icon->outline('link') . '</span>',
							['controller' => 'Cities', 'action' => 'view', $user->city->id],
							[
								'class' => 'text-reset text-decoration-none fw-bold',
								'escape' => false,
								'data-bs-toggle' => 'tooltip',
								'data-bs-html' => 'true',
								'data-bs-placement' => 'top',
								'title' => '<b>' . h($user->city->name) . '</b><br>' . __('adatlap megtekintése'),
							]
						) : '' ?>
						
					</td>
                    <td class="string club_id">
						<?= $user->hasValue('club') ? $this->Html->link(
							h($user->club->name) . '<span class="icon-link-subtle ms-1">' . $this->Icon->outline('link') . '</span>',
							['controller' => 'Clubs', 'action' => 'view', $user->club->id],
							[
								'class' => 'text-reset text-decoration-none fw-bold',
								'escape' => false,
								'data-bs-toggle' => 'tooltip',
								'data-bs-html' => 'true',
								'data-bs-placement' => 'top',
								'title' => '<b>' . h($user->club->name) . '</b><br>' . __('adatlap megtekintése'),
							]
						) : '' ?>
						
					</td>
                    <td class="string first_name"><?= $highlight($user->first_name) ?>&nbsp;<?= $highlight($user->last_name) ?></td>
                    <td class="string email"><?= $highlight($user->email) ?></td>
                    <td class="string phone"><?= $highlight($user->phone) ?></td>
                    <td class="boolean active"><?= $user->active ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
                    <td class="boolean enabled"><?= $user->enabled ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
                    <td class="string role"><?= $highlight($user->role) ?></td>
<?php if ((isset($showCreated) && $showCreated) || (isset($showModified) && $showModified)): ?>
                    <td class="datetime text-nowrap">
<?php if (isset($showCreated) && $showCreated): ?>
                        <small class="d-block text-muted"><?= h($user->created?->format('Y-m-d H:i')) ?></small>
<?php endif; ?>
<?php if (isset($showModified) && $showModified): ?>
                        <span><?= h($user->modified?->format('Y-m-d H:i')) ?></span>
<?php endif; ?>
                    </td>
<?php endif; ?>
                    <td class="actions">
                        <div class="btn-list flex-nowrap align-items-center">
                            <?= $this->KvForm->actionView(['action' => 'view', $user->id]) ?>
                            <?= $this->KvForm->actionEdit(['action' => 'edit', $user->id]) ?>
                            <?= $this->KvForm->actionDelete(['action' => 'delete', $user->id], (string)($user->username ?? '')) ?>
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

        // --- 2. AUTOMATIKUS FINOM GÖRGETÉS AZ UTOLSÓ REKORDHOZ ---
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