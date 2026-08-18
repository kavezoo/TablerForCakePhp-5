<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Country> $countries
 * @var int|null $lastViewedId
 * @var int|null $scrollToId
 * @var string|null $search
 */
use Cake\I18n\I18n;

$showCreated = false;
$showModified = false;

$this->assign('title', __('Countries'));
$this->element('KvAdmin.pagination_templates');

$lastViewedId = $lastViewedId ?? $this->getRequest()->getSession()->read('LastViewed.country_id');
$scrollToId = $scrollToId ?? $this->getRequest()->getSession()->read('ScrollTo.country_id') ?? $lastViewedId;

// 🔍 Keresési kiemelő segédfüggvény
/*
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
*/
?>

<div class="card">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">

            <!-- Új rekord gomb -->
            <div class="col-auto">
                <?= $this->Html->link(
                    $this->Icon->outline('plus') . '<span class="d-none d-sm-inline ms-1">' . __('Új Country') . '</span>',
                    ['action' => 'add'],
                    [
                        'escape' => false,
                        'class' => 'btn btn-outline-secondary btn-header-new'
                    ]
                ) ?>
            </div>

            <!-- Cím és infó blokk -->
            <div class="col">
                <h3 class="card-title mb-0"><?= __('Countries') ?></h3>
                <p class="text-secondary m-0"><?= __('Duplaklikkelés') . ': ' . __('edit') ?></p>
            </div>

            <!-- Kereső űrlap -->
            <div class="col-12 col-md-auto ms-md-auto">
                <?= $this->Form->create(null, ['type' => 'get', 'valueSources' => ['query']]) ?>
                    <?php if (!empty($this->getRequest()->getQuery('sort'))): ?>
                        <?= $this->Form->hidden('sort', ['value' => $this->getRequest()->getQuery('sort')]) ?>
                        <?= $this->Form->hidden('direction', ['value' => $this->getRequest()->getQuery('direction')]) ?>
                    <?php endif; ?>

                    <div class="input-group input-group-flat search-input-group w-100 position-relative">
                        <span class="input-group-text search-box-left-side">
                            <?= $this->Icon->outline('search') ?>
                        </span>
                        <input 
                            id="advanced-table-search" 
                            type="text" 
                            name="search" 
                            class="form-control" 
                            placeholder="<?= __('Search...') ?>" 
                            value="<?= h($search ?? '') ?>" 
                            autocomplete="off"
                        >
                        
                        <?php if (!empty($search)): ?>
                            <span class="input-group-text pe-2 py-0 d-flex align-items-center">
                                <a href="<?= $this->Url->build(['action' => 'index', '?' => ['clear' => 'search']]) ?>" 
                                    id="btn-clear-search"
                                    class="btn-search-clear text-muted text-decoration-none" 
                                    title="<?= __('Keresés törlése és összes rekord mutatása') ?>"
                                    data-bs-toggle="tooltip"
                                    data-bs-html="true"
                                    data-bs-placement="top">
                                    <?= $this->Icon->outline('x') ?>
                                </a>
                            </span>
                        <?php else: ?>
                            <span class="input-group-text pe-2" style="border-left-width: 0px; border-left-style: none;">
                                <kbd id="search-shortcut-hint" class="search-kbd-badge">ctrl + K</kbd>
                            </span>
                        <?php endif; ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
            <thead>
                <tr>
                                                <th class="id"><?= $this->Paginator->sort('id', '#') ?></th>
                                                <th class="string link"><?= $this->Paginator->sort('continent_id', __('Continents')) ?></th>
												<th class="string"><?= $this->Paginator->sort('iso2', __('Iso2')) ?></th>
												<th class="string"><?= $this->Paginator->sort('name', __('Name')) ?></th>
												<th class="string"><?= $this->Paginator->sort('endonim_name', __('Endonim Name')) ?></th>
												<th class="string"><?= $this->Paginator->sort('locale', __('Locale')) ?></th>
												<th class="string"><?= $this->Paginator->sort('timezone', __('Timezone')) ?></th>
												<th class="string"><?= $this->Paginator->sort('phone_prefix', __('Phone Prefix')) ?></th>
												<th class="string"><?= $this->Paginator->sort('logo', __('Logo')) ?></th>
												<th class="string"><?= $this->Paginator->sort('currency', __('Currency')) ?></th>
												<th class="boolean"><?= $this->Paginator->sort('visible', __('Visible')) ?></th>
												<th class="integer count"><?= $this->Paginator->sort('pos', __('Pos')) ?></th>
												<th class="integer count"><?= $this->Paginator->sort('club_count', __('Club Count')) ?></th>
												<th class="integer count"><?= $this->Paginator->sort('setup_count', __('Setup Count')) ?></th>
												<th class="integer count"><?= $this->Paginator->sort('user_count', __('User Count')) ?></th>
<?php if ($showCreated || $showModified): ?>
                    <th class="datetime">
<?php if ($showCreated): ?>
                        <?= $this->Paginator->sort('created', __('Létrehozva')) ?>
<?php endif; ?>
<?php if ($showCreated && $showModified): ?>
                        <br>
<?php endif; ?>
<?php if ($showModified): ?>
                        <?= $this->Paginator->sort('modified', __('Módosítva')) ?>
<?php endif; ?>
                    </th>
<?php endif; ?>
                                                                        <th class="actions w-1"><?= __('Műveletek') ?></th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($countries) && count($countries) > 0): ?>
                    <?php foreach ($countries as $country): ?>
                        <?php 
                            $isLastViewed = (!empty($lastViewedId) && (int)$country->id === (int)$lastViewedId); 
                        ?>
                        <tr 
                            id="row-<?= (int)$country->id ?>" 
                            class="<?= $isLastViewed ? 'last-viewed' : '' ?>"
                        >
                                                        <td class="id"><?= h($country->id) ?></td>
                                                        <td>
                                <?= $country->hasValue('continent') ? $this->Html->link(
                                    h($country->continent->name) . '<span class="icon-link-subtle">' . $this->Icon->outline('link') . '</span>',
                                    ['controller' => 'Continents', 'action' => 'view', $country->continent->id],
                                    [
                                        'escape' => false,
                                        'class' => 'text-reset text-decoration-none fw-bold',
                                        'data-bs-toggle' => 'tooltip',
                                        'data-bs-html' => 'true',
                                        'data-bs-placement' => 'top',
                                        'title' => __('Continents megtekintése:<br><strong>{0}</strong>', h($country->continent->name))
                                    ]
                                ) : '' ?>
                            </td>
                                                                    <td class="font-weight-medium"><?= h($country->iso2) ?></td>
                                                            <td class="font-weight-medium"><?= h($country->name) ?></td>
                                                            <td class="font-weight-medium"><?= h($country->endonim_name) ?></td>
                                                            <td class="font-weight-medium"><?= h($country->locale) ?></td>
                                                            <td class="font-weight-medium"><?= h($country->timezone) ?></td>
                                                            <td class="font-weight-medium"><?= h($country->phone_prefix) ?></td>
                                                            <td class="font-weight-medium"><?= h($country->logo) ?></td>
                                                            <td class="font-weight-medium"><?= h($country->currency) ?></td>
                                                            <td class="boolean">
                                <?= $this->SystemIcon->boolean($country->visible ?? true) ?>
                            </td>
                                                            <td class="text-center">
                                <?= $this->Number->format($country->pos ?? 0) ?>
                            </td>
                                                            <td class="text-center">
                                <?= $this->Number->format($country->club_count ?? 0) ?>
                            </td>
                                                            <td class="text-center">
                                <?= $this->Number->format($country->setup_count ?? 0) ?>
                            </td>
                                                            <td class="text-center">
                                <?= $this->Number->format($country->user_count ?? 0) ?>
                            </td>
                                        <?php if ($showCreated || $showModified): ?>
                            <td class="datetime created modified">
<?php if ($showCreated): ?>
                                <?= $country->created ? $country->created->format('Y.m.d. H:i') : '-' ?><br>
<?php endif; ?>
<?php if ($showCreated && $showModified): ?>
                                <br>
<?php endif; ?>
<?php if ($showModified): ?>
                                <?= $country->modified ? $country->modified->format('Y.m.d. H:i') : '-' ?>
<?php endif; ?>
                            </td>
<?php endif; ?>
                                                                                <td class="actions">
                                <div class="btn-list flex-nowrap align-items-center">
                                    <!-- Megtekintés (View) -->
                                    <?= $this->Html->link(
                                        $this->Icon->outline('eye'),
                                        ['action' => 'view', $country->id],
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-icon btn-action-default',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'top',
                                            'title' => __('View')
                                        ]
                                    ) ?>

                                    <!-- Szerkesztés (Edit) -->
                                    <?= $this->Html->link(
                                        $this->Icon->outline('edit'),
                                        ['action' => 'edit', $country->id],
                                        [
                                            'escape' => false,
                                            'class' => 'btn btn-icon btn-action-default',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'top',
                                            'title' => __('Edit')
                                        ]
                                    ) ?>

                                    <!-- Törlés (Modal indító) -->
                                    <span title="<?= __('Delete') ?>" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <button type="button" 
                                                data-name="<?= h($country->name) ?>"
                                                data-url="<?= $this->Url->build(['action' => 'delete', $country->id]) ?>"
                                                class="btn btn-icon btn-action-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#delete-modal">
                                            <?= $this->Icon->outline('x') ?>
                                        </button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="20" class="text-center text-muted py-4">
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
        let targetRow = document.getElementById('row-\" . (int)$scrollToId . \"');
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