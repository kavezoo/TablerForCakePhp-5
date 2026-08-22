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
$showVisible       = true;
$showCreated       = false;
$showModified      = false;
$showPos           = false;

$this->assign('title', __('Users'));
$this->element('KvAdmin.pagination_templates');

$lastViewedId = $lastViewedId ?? $session->read('LastViewed.' . $prefix . '.user_id');
$scrollToId = $scrollToId ?? $session->read('ScrollTo.' . $prefix . '.user_id') ?? $lastViewedId;

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
                <p class="text-secondary m-0"><?= __('Edit line double click on the line') ?></p>
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
					<th class="string username"><?= $this->Paginator->sort('username') ?></th>					
					<th class="string email"><?= $this->Paginator->sort('email') ?></th>					
					<th class="string first_name"><?= $this->Paginator->sort('first_name') ?></th>					
					<th class="string last_name"><?= $this->Paginator->sort('last_name') ?></th>					
					<th class="string phone"><?= $this->Paginator->sort('phone') ?></th>					
					<th class="string avatar"><?= $this->Paginator->sort('avatar') ?></th>					
					<th class="datetime token_expires"><?= $this->Paginator->sort('token_expires') ?></th>					
					<th class="string api_token"><?= $this->Paginator->sort('api_token') ?></th>					
					<th class="datetime activation_date"><?= $this->Paginator->sort('activation_date') ?></th>					
					<th class="string secret"><?= $this->Paginator->sort('secret') ?></th>					
					<th class="boolean secret_verified"><?= $this->Paginator->sort('secret_verified') ?></th>					
					<th class="datetime tos_date"><?= $this->Paginator->sort('tos_date') ?></th>					
					<th class="boolean active"><?= $this->Paginator->sort('active') ?></th>					
					<th class="boolean enabled"><?= $this->Paginator->sort('enabled') ?></th>					
					<th class="boolean is_superuser"><?= $this->Paginator->sort('is_superuser') ?></th>					
					<th class="string role"><?= $this->Paginator->sort('role') ?></th>					
					<th class="string membership_status"><?= $this->Paginator->sort('membership_status') ?></th>					
					<th class="date membership_joined_date"><?= $this->Paginator->sort('membership_joined_date') ?></th>					
					<th class="date club_membership_fee_date"><?= $this->Paginator->sort('club_membership_fee_date') ?></th>					
					<th class="date national_membership_fee_date"><?= $this->Paginator->sort('national_membership_fee_date') ?></th>					
					<th class="boolean application_notified"><?= $this->Paginator->sort('application_notified') ?></th>					
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
					<th class="datetime last_login"><?= $this->Paginator->sort('last_login') ?></th>					
					<th class="datetime lockout_time"><?= $this->Paginator->sort('lockout_time') ?></th>					
					<th class="string login_token"><?= $this->Paginator->sort('login_token') ?></th>					
					<th class="datetime login_token_date"><?= $this->Paginator->sort('login_token_date') ?></th>					
					<th class="boolean token_send_requested"><?= $this->Paginator->sort('token_send_requested') ?></th>					
                    <th class="actions w-1"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users) && count($users) > 0): ?>
                <?php foreach ($users as $user): ?>
                <?php $isLastViewed = (!empty($lastViewedId) && $lastViewedId == $user->id); ?>
                <tr
                    id="row-<?= (int)$user->id ?>"
                    class="<?= $isLastViewed ? 'last-viewed' : '' ?>"
                    data-edit-url="<?= $this->Url->build(['action' => 'edit', $user->id]) ?>"
                >
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
                    <td class="string username"><?= $highlight($user->username) ?></td>
                    <td class="string email"><?= $highlight($user->email) ?></td>
                    <td class="string first_name"><?= $highlight($user->first_name) ?></td>
                    <td class="string last_name"><?= $highlight($user->last_name) ?></td>
                    <td class="string phone"><?= $highlight($user->phone) ?></td>
                    <td class="string avatar"><?= $highlight($user->avatar) ?></td>
                    <td class="datetime text-nowrap"><?= h($user->token_expires?->format('Y-m-d H:i')) ?></td>
                    <td class="string api_token"><?= $highlight($user->api_token) ?></td>
                    <td class="datetime text-nowrap"><?= h($user->activation_date?->format('Y-m-d H:i')) ?></td>
                    <td class="string secret"><?= $highlight($user->secret) ?></td>
                    <td class="boolean secret_verified"><?= $user->secret_verified ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
                    <td class="datetime text-nowrap"><?= h($user->tos_date?->format('Y-m-d H:i')) ?></td>
                    <td class="boolean active"><?= $user->active ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
                    <td class="boolean enabled"><?= $user->enabled ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
                    <td class="boolean is_superuser"><?= $user->is_superuser ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
                    <td class="string role"><?= $highlight($user->role) ?></td>
                    <td class="string membership_status"><?= $highlight($user->membership_status) ?></td>
                    <td class="date text-nowrap"><?= h($user->membership_joined_date?->format('Y-m-d')) ?></td>
                    <td class="date text-nowrap"><?= h($user->club_membership_fee_date?->format('Y-m-d')) ?></td>
                    <td class="date text-nowrap"><?= h($user->national_membership_fee_date?->format('Y-m-d')) ?></td>
                    <td class="boolean application_notified"><?= $user->application_notified ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
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
                    <td class="datetime text-nowrap"><?= h($user->last_login?->format('Y-m-d H:i')) ?></td>
                    <td class="datetime text-nowrap"><?= h($user->lockout_time?->format('Y-m-d H:i')) ?></td>
                    <td class="string login_token"><?= $highlight($user->login_token) ?></td>
                    <td class="datetime text-nowrap"><?= h($user->login_token_date?->format('Y-m-d H:i')) ?></td>
                    <td class="boolean token_send_requested"><?= $user->token_send_requested ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
                    <td class="actions">
                        <div class="btn-list flex-nowrap align-items-center">
                            <?= $this->KvForm->actionView(['action' => 'view', $user->id]) ?>
                            <?= $this->KvForm->actionEdit(['action' => 'edit', $user->id]) ?>
                            <?= $this->KvForm->actionDelete(['action' => 'delete', $user->id], (string)($user->first_name ?? '')) ?>
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