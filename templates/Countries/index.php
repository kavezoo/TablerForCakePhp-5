<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\> $countries
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

$this->assign('title', __('Countries'));
$this->element('KvAdmin.pagination_templates');

$lastViewedId = $lastViewedId ?? $this->getRequest()->getSession()->read('LastViewed.country_id');
$scrollToId = $scrollToId ?? $this->getRequest()->getSession()->read('ScrollTo.country_id') ?? $lastViewedId;

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

            <!-- Új country gomb -->
            <div class="col-auto">
                <?= $this->Html->link($this->Icon->outline('plus') . '<span class="d-none d-sm-inline ms-1">' . __('Add new') . ' ' . __('country') . '</span>', ['controller' => '', 'action' => 'add'], ['escape' => false, 'class' => 'btn btn-outline-secondary btn-header-new']) ?>
            </div>

            <!-- Cím és infó blokk -->
            <div class="col">
                <h3 class="card-title mb-0"><?= __('Countries') ?></h3>
                <p class="text-secondary m-0"><?= __('Double-click on the line') . ' ' . __('edit') ?></p>
            </div>

            <!-- Kereső űrlap -->
            <div class="col-12 col-md-auto ms-md-auto">
                <?= $this->KvAdmin->search('search', ['controller' => '', 'action' => 'index', '?' => ['clear' => 'search']]) ?>
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
                    <th class="integer continent_id"><?= $this->Paginator->sort('continent_id') ?></th>
                    <th class="char iso2"><?= $this->Paginator->sort('iso2') ?></th>
                    <th class="string name"><?= $this->Paginator->sort('name') ?></th>
                    <th class="string endonim_name"><?= $this->Paginator->sort('endonim_name') ?></th>
                    <th class="string locale"><?= $this->Paginator->sort('locale') ?></th>
                    <th class="string timezone"><?= $this->Paginator->sort('timezone') ?></th>
                    <th class="string phone_prefix"><?= $this->Paginator->sort('phone_prefix') ?></th>
                    <th class="string logo"><?= $this->Paginator->sort('logo') ?></th>
                    <th class="string currency"><?= $this->Paginator->sort('currency') ?></th>
<?php if (isset($showVisible) && $showVisible): ?>
                    <th class="boolean visible"><?= $this->Paginator->sort('visible', __('Visible')) ?></th>
<?php endif; ?>
<?php if (isset($showPos) && $showPos): ?>
                    <th class="integer pos"><?= $this->Paginator->sort('pos', __('Pos')) ?></th>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <th class="integer club_count"><?= $this->Paginator->sort('club_count') ?></th>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <th class="integer setup_count"><?= $this->Paginator->sort('setup_count') ?></th>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <th class="biginteger user_count"><?= $this->Paginator->sort('user_count') ?></th>
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
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($countries) && count($countries) > 0): ?>
                <?php foreach ($countries as $country): ?>
                <?php $isLastViewed = (!empty($lastViewedId) && $lastViewedId == $country->id); ?>
                <tr id="row-<?= (int)$country->id ?>" class="<?= $isLastViewed ? 'last-viewed' : '' ?>">
<?php if (isset($showId) && $showId): ?>
                    <td class="integer id"><?= h($country->id) ?></td>
<?php endif; ?>
                    <td class="integer continent_id"><?= $country->hasValue('continent') ? $this->Html->link($country->continent->name, ['controller' => 'Continents', 'action' => 'view', $country->continent->id]) : '' ?></td>
                    <td class="char iso2"><?= $highlight($country->iso2) ?></td>
                    <td class="string name"><?= $highlight($country->name) ?></td>
                    <td class="string endonim_name"><?= $highlight($country->endonim_name) ?></td>
                    <td class="string locale"><?= $highlight($country->locale) ?></td>
                    <td class="string timezone"><?= $highlight($country->timezone) ?></td>
                    <td class="string phone_prefix"><?= $highlight($country->phone_prefix) ?></td>
                    <td class="string logo"><?= $highlight($country->logo) ?></td>
                    <td class="string currency"><?= $highlight($country->currency) ?></td>
<?php if (isset($showVisible) && $showVisible): ?>
                    <td class="boolean visible"><?= $country->visible ? '<span class="badge bg-green-lt">' . __('Igen') . '</span>' : '<span class="badge bg-secondary-lt">' . __('Nem') . '</span>' ?></td>
<?php endif; ?>
<?php if (isset($showPos) && $showPos): ?>
                    <td class="integer pos"><?= h($country->pos) ?></td>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <td class="integer club_count text-end"><?= $this->Number->format($country->club_count) ?></td>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <td class="integer setup_count text-end"><?= $this->Number->format($country->setup_count) ?></td>
<?php endif; ?>
<?php if (isset($showCounterFields) && $showCounterFields): ?>
                    <td class="biginteger user_count text-end"><?= $this->Number->format($country->user_count) ?></td>
<?php endif; ?>
<?php if ((isset($showCreated) && $showCreated) || (isset($showModified) && $showModified)): ?>
                    <td class="datetime text-nowrap">
<?php if (isset($showCreated) && $showCreated): ?>
                        <small class="d-block text-muted"><?= h($country->created?->format('Y-m-d H:i')) ?></small>
<?php endif; ?>
<?php if (isset($showModified) && $showModified): ?>
                        <span><?= h($country->modified?->format('Y-m-d H:i')) ?></span>
<?php endif; ?>
                    </td>
<?php endif; ?>
                    <td class="actions">
                        <div class="btn-list flex-nowrap align-items-center">
                            <?= $this->KvAdmin->actionView(['action' => 'view', $country->id]) ?>
                            <?= $this->KvAdmin->actionEdit(['action' => 'edit', $country->id]) ?>
                            <?= $this->KvAdmin->actionDelete(['action' => 'delete', $country->id], (string)($country->name ?? '')) ?>
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