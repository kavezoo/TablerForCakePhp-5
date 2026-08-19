<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\City> $cities
 * @var int|null $lastViewedId
 * @var int|null $scrollToId
 * @var string|null $search
 */
use Cake\I18n\I18n;

$showId 			= false;
$showCounterFields 	= false;
$showVisible 		= false;
$showCreated 		= false;
$showModified 		= false;

$this->assign('title', __('Cities'));
$this->element('KvAdmin.pagination_templates');

$lastViewedId = $lastViewedId ?? $this->getRequest()->getSession()->read('LastViewed.city_id');
$scrollToId = $scrollToId ?? $this->getRequest()->getSession()->read('ScrollTo.city_id') ?? $lastViewedId;

// 🔍 Keresési kiemelő segédfüggvény
$highlight = function (?string $text) use ($search): string {
    if ($text === null || $text === '') {
        return '';
    }

    $escapedText = h($text);
    if (!empty($search)) {
        $cleanSearch = preg_quote(trim($search), '/');
        return preg_replace('/(' . $cleanSearch . ')/iu', '<mark class="search-highlight">$1</mark>', $escapedText );
    }
    return $escapedText;
};
?>


<div class="card">
    <div class="card-header pe-3">
        <div class="row w-full align-items-center gy-2 gy-md-0">

            <!-- Új település gomb (a cím előtt) -->
            <div class="col-auto">
                <?= $this->Html->link(
                    $this->Icon->outline('plus') . '<span class="d-none d-sm-inline ms-1">' . __('Új település') . '</span>',
                    ['controller' => 'Cities', 'action' => 'add'],
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
<?php /*
            <!-- Kereső mező -->
            <div class="input-group input-group-flat search-input-group w-100 w-md-auto">
                <span class="input-group-text">
                    <?= $this->Icon->outline('search') ?>
                </span>
                <input id="advanced-table-search" type="text" class="form-control" placeholder="<?= __('Search...') ?>" autocomplete="off">
                <span class="input-group-text pe-2">
                    <kbd id="search-shortcut-hint" class="search-kbd-badge">ctrl + K</kbd>
                </span>
            </div>
*/ ?>

			<!-- Kereső űrlap -->
			<div class="col-12 col-md-auto ms-md-auto">
				<?= $this->Form->create(null, ['type' => 'get', 'valueSources' => ['query']]) ?>
					<!-- Megtartjuk az esetleges oszloprendezést keresés közben -->
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
						
							<!-- Keresés törlése gomb (X) -->
							<span class="input-group-text pe-2 py-0 d-flex align-items-center">
								<a href="<?= $this->Url->build(['controller' => 'Cities', 'action' => 'index', '?' => ['clear' => 'search']]) ?>" 
									id="btn-clear-search"
									class="btn-search-clear text-muted text-decoration-none" 
									title="<?= __('Keresés törlése és összes rekord mutatása') ?>"
									data-bs-toggle = 'tooltip'
									data-bs-html = 'true'
									data-bs-placement = 'top'>
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
<?php if(isset($showId) && $showId){ ?>

                    <th class="id"><?= $this->Paginator->sort('id', '#') ?></th>
<?php } ?>
                    <th class="string"><?= $this->Paginator->sort('name', __('Név')) ?></th>
                    <th class="text-center"><?= $this->Paginator->sort('zip', __('Irányítószám')) ?></th>
                    <th class="number"><?= $this->Paginator->sort('zip', __('Number')) ?></th>
                    <th class="currency"><?= $this->Paginator->sort('zip', __('Currency')) ?></th>
                    <th class="string"><?= $this->Paginator->sort('shortname', __('Rövid név')) ?></th>
                    <th class="string link"><?= $this->Paginator->sort('county_id', __('Megye')) ?></th>
                    <th class="string link"><?= $this->Paginator->sort('country_id', __('Ország')) ?></th>
<?php if(isset($showCounterFields) && $showCounterFields){ ?>

                    <th class="integer count"><?= $this->Paginator->sort('club_count', __('Clubs')) ?></th>
<?php } ?>

					<th class="datetime"><?= $this->Paginator->sort('datumido') ?></th>
					<th class="date"><?= $this->Paginator->sort('datum') ?></th>
					<th class="time"><?= $this->Paginator->sort('ido') ?></th>
<?php if(isset($showVisible) && $showVisible){ ?>

                    <th class="boolean"><?= $this->Paginator->sort('is_active', __('Aktív')) ?></th>
<?php } ?>
<?php if(isset($showCreated) && $showCreated || isset($showModified) && $showModified){ ?>

                    <th class="datetime">
<?php 	if($showCreated){ ?>

                        <?= $this->Paginator->sort('created', __('Létrehozva')) ?>
<?php 	} ?>
<?php if($showCreated && $showModified){ ?>
						<br>
<?php 	} ?>
<?php 	if($showModified){ ?>

                        <?= $this->Paginator->sort('modified', __('Módosítva')) ?>
<?php 	} ?>

                    </th>
<?php } ?>

                    <th class="actions w-1"><?= __('Műveletek') ?></th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($cities) && count($cities) > 0): ?>
                    <?php foreach ($cities as $city): ?>
                        <?php 
                            $isLastViewed = (!empty($lastViewedId) && (int)$city->id === (int)$lastViewedId); 
                        ?>
                        <tr 
                            id="row-<?= (int)$city->id ?>" 
                            class="<?= $isLastViewed ? 'last-viewed' : '' ?>"
                        >
<?php if(isset($showCounterFields) && $showCounterFields){ ?>
                            <td class="id"><?= h($city->id) ?></td>
<?php } ?>

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
									h($city->county->name) . '<span class="icon-link-subtle">' . $this->Icon->outline('link') . '</span>',
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
									h($city->country->name) . '<span class="icon-link-subtle">' . $this->Icon->outline('link') . '</span>',
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

<?php if(isset($showCounterFields) && $showCounterFields){ ?>
                            <td class="text-center">
                                <?= $this->Number->format($city->club_count ?? 0) ?>
                            </td>
<?php } ?>


                            <td class="text-center">
                                <?= h($city->datumido) ?>
                            </td>
                            <td class="text-center">
                                <?= h($city->datum) ?>
                            </td>
                            <td class="text-center">
                                <?= h($city->ido) ?>
                            </td>

<?php if(isset($showVisible) && $showVisible){ ?>
                            <td class="boolean">
                                <?= $this->SystemIcon->boolean($city->is_active ?? true) ?>
                            </td>
<?php } ?>
                            
                            
                                
                                

<?php if($showCreated || $showModified){ ?>

							<td class="datetime created modified">
<?php 	if($showCreated){ ?>

                        <?= $city->created ? $city->created->format('Y.m.d. H:i') : '-' ?><br>
<?php 	} ?>
<?php if($showCreated && $showModified){ ?>
						<br>
<?php 	} ?>
<?php 	if($showModified){ ?>

                        <?= $city->modified ? $city->modified->format('Y.m.d. H:i') : '-' ?>
<?php 	} ?>

							</td>
<?php } ?>




                            
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
                <?php else: ?>
                    <tr>
                        <td colspan="12" class="text-center text-muted py-4">
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
            // Gyorsbillentyű fókuszhoz (Ctrl + K vagy Cmd + K)
            document.addEventListener('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
                    e.preventDefault();
                    searchInput.focus();
                    searchInput.select();
                }
            });

            // Fókusz esetén visszajelzés
            if (shortcutHint) {
                searchInput.addEventListener('focus', function () {
                    shortcutHint.innerHTML = 'Enter &crarr;';
                });

                searchInput.addEventListener('blur', function () {
                    shortcutHint.textContent = 'ctrl + K';
                });
            }

            // Escape lenyomására fókusz elvétele
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