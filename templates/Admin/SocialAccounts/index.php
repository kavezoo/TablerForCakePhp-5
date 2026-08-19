<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\> $socialAccounts
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

$this->assign('title', __('Socialaccounts'));
$this->element('KvAdmin.pagination_templates');

$lastViewedId = $lastViewedId ?? $this->getRequest()->getSession()->read('LastViewed.socialAccount_id');
$scrollToId = $scrollToId ?? $this->getRequest()->getSession()->read('ScrollTo.socialAccount_id') ?? $lastViewedId;

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

            <!-- Új socialAccount gomb -->
            <div class="col-auto">
                <?= $this->Html->link($this->Icon->outline('plus') . '<span class="d-none d-sm-inline ms-1">' . __('Add new') . ' ' . __('socialAccount') . '</span>', ['controller' => 'Socialaccounts', 'action' => 'add'], ['escape' => false, 'class' => 'btn btn-outline-secondary btn-header-new']) ?>
            </div>

            <!-- Cím és infó blokk -->
            <div class="col">
                <h3 class="card-title mb-0"><?= __('Socialaccounts') ?></h3>
                <p class="text-secondary m-0"><?= __('Double-click on the line') . ' ' . __('edit') ?></p>
            </div>

            <!-- Kereső űrlap -->
            <div class="col-12 col-md-auto ms-md-auto">
                <?= $this->KvForm->search('search', ['controller' => 'Socialaccounts', 'action' => 'index', '?' => ['clear' => 'search']]) ?>
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
					<th class="string user_id"><?= $this->Paginator->sort('user_id') ?></th>					
					<th class="string provider"><?= $this->Paginator->sort('provider') ?></th>					
					<th class="string username"><?= $this->Paginator->sort('username') ?></th>					
					<th class="string reference"><?= $this->Paginator->sort('reference') ?></th>					
					<th class="string link"><?= $this->Paginator->sort('link') ?></th>					
					<th class="string token_secret"><?= $this->Paginator->sort('token_secret') ?></th>					
					<th class="datetime token_expires"><?= $this->Paginator->sort('token_expires') ?></th>					
					<th class="boolean active"><?= $this->Paginator->sort('active') ?></th>					
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
                <?php if (!empty($socialAccounts) && count($socialAccounts) > 0): ?>
                <?php foreach ($socialAccounts as $socialAccount): ?>
                <?php $isLastViewed = (!empty($lastViewedId) && $lastViewedId == $socialAccount->id); ?>
                <tr
                    id="row-<?= (int)$socialAccount->id ?>"
                    class="<?= $isLastViewed ? 'last-viewed' : '' ?>"
                    data-edit-url="<?= $this->Url->build(['action' => 'edit', $socialAccount->id]) ?>"
                >
<?php if (isset($showId) && $showId): ?>
                    <td class="uuid id"><?= h($socialAccount->id) ?></td>
<?php endif; ?>
                    <td class="string user_id">
						<?= $socialAccount->hasValue('user') ? $this->Html->link(
							h($socialAccount->user->first_name) . '<span class="icon-link-subtle ms-1">' . $this->Icon->outline('link') . '</span>',
							['controller' => 'Users', 'action' => 'view', $socialAccount->user->id],
							[
								'class' => 'text-reset text-decoration-none fw-bold',
								'escape' => false,
								'data-bs-toggle' => 'tooltip',
								'data-bs-html' => 'true',
								'data-bs-placement' => 'top',
								'title' => '<b>' . h($socialAccount->user->first_name) . '</b><br>' . __('adatlap megtekintése'),
							]
						) : '' ?>
						
					</td>
                    <td class="string provider"><?= $highlight($socialAccount->provider) ?></td>
                    <td class="string username"><?= $highlight($socialAccount->username) ?></td>
                    <td class="string reference"><?= $highlight($socialAccount->reference) ?></td>
                    <td class="string link"><?= $highlight($socialAccount->link) ?></td>
                    <td class="string token_secret"><?= $highlight($socialAccount->token_secret) ?></td>
                    <td class="datetime text-nowrap"><?= h($socialAccount->token_expires?->format('Y-m-d H:i')) ?></td>
                    <td class="boolean active"><?= $socialAccount->active ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
<?php if ((isset($showCreated) && $showCreated) || (isset($showModified) && $showModified)): ?>
                    <td class="datetime text-nowrap">
<?php if (isset($showCreated) && $showCreated): ?>
                        <small class="d-block text-muted"><?= h($socialAccount->created?->format('Y-m-d H:i')) ?></small>
<?php endif; ?>
<?php if (isset($showModified) && $showModified): ?>
                        <span><?= h($socialAccount->modified?->format('Y-m-d H:i')) ?></span>
<?php endif; ?>
                    </td>
<?php endif; ?>
                    <td class="actions">
                        <div class="btn-list flex-nowrap align-items-center">
                            <?= $this->KvForm->actionView(['action' => 'view', $socialAccount->id]) ?>
                            <?= $this->KvForm->actionEdit(['action' => 'edit', $socialAccount->id]) ?>
                            <?= $this->KvForm->actionDelete(['action' => 'delete', $socialAccount->id], (string)($socialAccount->provider ?? '')) ?>
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