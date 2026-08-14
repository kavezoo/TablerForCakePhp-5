<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\City> $cities
 */
use Cake\I18n\I18n;

$this->assign('title', __('Cities'));
$this->element('admin/pagination_templates');

$lastViewedId = $this->getRequest()->getSession()->read('LastViewed.city_id');
?>

<div class="card">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">

            <!-- Új település gomb (a cím előtt) -->
<div class="col-auto">
    <?= $this->Html->link(
        $this->Icon->outline('plus') . '<span class="d-none d-sm-inline">' . __('Új település') . '</span>',
        ['prefix' => 'Admin', 'controller' => 'Cities', 'action' => 'add'],
        [
            'escape' => false,
            'class' => 'btn btn-outline-secondary btn-header-new'
        ]
    ) ?>
</div>

            <!-- Cím és infó blokk -->
            <div class="col">
                <h3 class="card-title mb-0"><?= __('Cities') ?></h3>
                <p class="text-secondary m-0"><?= __('Duplaklikkelés') . ': ' . __('edit') ?></p>
            </div>

<!-- Kereső mező -->
<div class="input-group input-group-flat search-input-group w-100 w-md-auto">
    <span class="input-group-text">
        <?= $this->SystemIcon->sysIcon('search') ?>
    </span>
    <input id="advanced-table-search" type="text" class="form-control" placeholder="<?= __('Search...') ?>" autocomplete="off">
    <span class="input-group-text pe-2">
        <kbd id="search-shortcut-hint" class="search-kbd-badge">ctrl + K</kbd>
    </span>
</div>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-vcenter card-table table-hover table-sm table-bordered-vertical">
            <thead>
                <tr>
                    <th class="id"><?= $this->Paginator->sort('id', '#') ?></th>
                    <th class="string"><?= $this->Paginator->sort('name', __('Név')) ?></th>
                    <th class="text-center"><?= $this->Paginator->sort('zip', __('Irányítószám')) ?></th>
                    <th class="number"><?= $this->Paginator->sort('zip', __('Number')) ?></th>
                    <th class="currency"><?= $this->Paginator->sort('zip', __('Currency')) ?></th>
                    <th class="string"><?= $this->Paginator->sort('shortname', __('Rövid név')) ?></th>
                    <th class="string link"><?= $this->Paginator->sort('county_id', __('Megye')) ?></th>
                    <th class="string link"><?= $this->Paginator->sort('country_id', __('Ország')) ?></th>
                    <th class="integer count"><?= $this->Paginator->sort('club_count', __('Clubs')) ?></th>
                    <th class="boolean"><?= $this->Paginator->sort('is_active', __('Aktív')) ?></th>
                    <th class="datetime">
                        <?= $this->Paginator->sort('created', __('Létrehozva')) ?><br>
                        <?= $this->Paginator->sort('modified', __('Módosítva')) ?>
                    </th>
                    <th class="actions w-1"><?= __('Műveletek') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cities as $city): ?>
                <?php $isLastViewed = ($city->id == $lastViewedId); ?>
                <tr class="<?= $isLastViewed ? 'last-viewed' : '' ?>">                
                    <td class="id"><?= h($city->id) ?></td>
                    <td class="font-weight-medium"><?= h($city->name) ?></td>
                    <td class="text-center"><?= h($city->zip) ?></td>
                    <td class="number"><?= h($city->zip) ?></td>
                    <td class="currency" currency="$" currency-position="prefix">
                        <?= $this->Number->format($city->zip, [
                            'locale' => I18n::getLocale()
                        ]) ?>
                    </td>                    
                    <td class="text-center"><?= h($city->shortname) ?></td>
                    
                    <!-- Megye kapcsolat -->
                    <td>
                        <?= $city->hasValue('county') ? $this->Html->link(
                            h($city->county->name) . ' <span class="text-muted d-inline-block" style="transform: translateY(4px);">' . $this->SystemIcon->sysIcon('link') . '</span>',
                            ['controller' => 'Counties', 'action' => 'view', $city->county->id],
                            [
                                'escape' => false,
                                'class' => 'text-reset text-decoration-none fw-bold',
                                'data-bs-toggle' => 'tooltip',
                                'data-bs-html' => 'true',
                                'data-bs-placement' => 'top',
                                'title' => __('Megye megtekintése:<br><strong>{0}</strong>', h($city->county->name))
                            ]
                        ) : '' ?>
                    </td>

                    <!-- Ország kapcsolat -->
                    <td>
                        <?= $city->hasValue('country') ? $this->Html->link(
                            h($city->country->name) . ' <span class="text-muted d-inline-block" style="transform: translateY(4px);">' . $this->SystemIcon->sysIcon('link') . '</span>',
                            ['controller' => 'Countries', 'action' => 'view', $city->country->id],
                            [
                                'escape' => false,
                                'class' => 'text-reset text-decoration-none fw-bold',
                                'data-bs-toggle' => 'tooltip',
                                'data-bs-html' => 'true',
                                'data-bs-placement' => 'top',
                                'title' => __('Ország megtekintése:<br><strong>{0}</strong>', h($city->country->name))
                            ]
                        ) : '' ?>
                    </td>

                    <td class="text-center">
                        <?= $this->Number->format($city->club_count ?? 0) ?>
                    </td>

                    <td class="boolean">
                        <?= $this->SystemIcon->boolean($city->is_active ?? true) ?>
                    </td>                            
                    
                    <td class="datetime created modified">
                        <?= $city->created ? $city->created->format('Y.m.d. H:i') : '-' ?><br>
                        <?= $city->modified ? $city->modified->format('Y.m.d. H:i') : '-' ?>
                    </td>
                    
                    <td class="actions">
                        <div class="btn-list flex-nowrap align-items-center">
                            <!-- Megtekintés (View) -->
                            <?= $this->Html->link(
                                $this->Icon->outline('eye'),
                                ['action' => 'view', $city->id],
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
                                ['action' => 'edit', $city->id],
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
                                        data-name="<?= h($city->name) ?>"
                                        data-url="<?= $this->Url->build(['action' => 'delete', $city->id]) ?>"
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
            </tbody>
        </table>
    </div>

    <?= $this->element('admin/pagination') ?>

</div>

<?= $this->element('admin/modal-delete') ?>



<?php
$this->Html->scriptBlock(
    "
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('advanced-table-search');
        const shortcutHint = document.getElementById('search-shortcut-hint');

        if (searchInput && shortcutHint) {
            // 1. Ctrl + K vagy Cmd + K gyorsgomb a fókuszhoz
            document.addEventListener('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
                    e.preventDefault();
                    searchInput.focus();
                    searchInput.select();
                }
            });

            // 2. Fókuszba lépés -> 'Enter ↵'
            searchInput.addEventListener('focus', function () {
                shortcutHint.innerHTML = 'Enter &crarr;';
            });

            // 3. Fókusz elvesztése -> 'ctrl + K'
            searchInput.addEventListener('blur', function () {
                shortcutHint.textContent = 'ctrl + K';
            });

            // 4. Escape megnyomásakor fókusz elvétele
            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    this.blur();
                }
            });
        }
    });
    ",
    ['block' => 'script']
);
?>