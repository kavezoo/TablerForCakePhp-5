<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 * @var \Cake\Collection\CollectionInterface|string[] $countries
 * @var \Cake\Collection\CollectionInterface|string[] $counties
 * @var \KvAdmin\View\Helper\KvFormHelper $KvForm
 */

$this->assign('title', __('Település módosítása'));
$list = ['JavaScript' => 'JavaScript', 'Ruby' => 'Ruby', 'HTML' => 'HTML'];
?>

<div class="page-header d-print-none mb-3">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('Település módosítása') ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="card">
    <?= $this->Form->create($city) ?>

    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <?= $this->Html->link(__('Datasheet'), '#tabs-datesheet', ['class' => 'nav-link active', 'data-bs-toggle' => 'tab', 'aria-selected' => 'true', 'role' => 'tab']) ?>
            </li>
            <li class="nav-item" role="presentation">
                <?= $this->Html->link(__('Biography'), '#tabs-biography', ['class' => 'nav-link', 'data-bs-toggle' => 'tab', 'aria-selected' => 'false', 'role' => 'tab', 'tabindex' => '-1']) ?>
            </li>
            <li class="nav-item ms-auto" role="presentation">
                <?= $this->Html->link($this->Icon->render('settings', ['class' => 'stroke-thin']), '#tabs-settings', ['escape' => false, 'class' => 'nav-link', 'data-bs-toggle' => 'tab', 'title' => __('Settings'), 'aria-selected' => 'false', 'role' => 'tab', 'tabindex' => '-1']) ?>
            </li>
        </ul>
    </div>

    <div class="card-body pb-4">
        <div class="tab-content">

			<!-- 1. Alapadatok fül -->
			<div class="tab-pane fade show active" id="tabs-datesheet" role="tabpanel">

				<div class="row g-3 mb-3">
					<div class="col-md-4">
						<?= $this->KvForm->dateTimePicker('datumido', ['label' => ['text' => __('Dátum és időpont')]]) ?>
					</div>
					<div class="col-md-4">
						<?= $this->KvForm->datePicker('datum', ['label' => ['text' => __('Dátum')]]) ?>
					</div>
					<div class="col-md-4">
						<?= $this->KvForm->timePicker('ido', ['label' => ['text' => __('Időpont')]]) ?>
					</div>
				</div>

				<div class="row g-3 mb-3">
					<div class="col-md-6">
						<?= $this->Form->control('name', ['label' => ['text' => __('Name'), 'class' => 'form-label'], 'class' => 'form-control', 'required' => true]) ?>
					</div>
					<div class="col-md-3">
						<?= $this->Form->control('zip', ['label' => ['text' => __('Zip'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
					</div>
					<div class="col-md-3">
						<?= $this->Form->control('shortname', ['label' => ['text' => __('Short name'), 'class' => 'form-label'], 'class' => 'form-control', 'required' => true]) ?>
					</div>
					<div class="col-md-6">
						<?= $this->Form->control('country_id', [
							'options' => $countries,
							'label' => ['text' => __('Country'), 'class' => 'form-label'],
							'class' => 'form-select tom-select',
							'empty' => __('Válasszon országot...')
						]) ?>
					</div>
					<div class="col-md-6">
						<?= $this->Form->control('county_id', [
							'options' => $counties,
							'label' => ['text' => __('County'), 'class' => 'form-label'],
							'class' => 'form-select tom-select',
							'empty' => __('Válasszon megyét...')
						]) ?>
					</div>
				</div>

				<div class="row g-3 mb-3">
					<!-- Tags (Többes választás) -->
					<div class="col-md-6">
						<?= $this->Form->control('tags', [
							'options' => $list,
							'type' => 'select',
							'multiple' => true,
							'label' => ['text' => __('Tags input'), 'class' => 'form-label'],
							'id' => 'select-tags',
							'class' => 'form-select tom-select multi-select',
							'empty' => false
						]) ?>
					</div>
					
					<!-- Number Spinner -->
					<div class="col-md-6">
						<?= $this->KvForm->numberSpinner('quantity', [
							'label' => ['text' => __('Mennyiség')],
							'min' => -10,
							'max' => 10,
							'step' => '0.25',
							'value' => '1.50',
						]) ?>
					</div>
				</div>

				<div class="row g-3">
					<!-- Telephone mask -->
					<div class="col-md-6">
						<?= $this->KvForm->maskedInput('phone', '+36 00/000-00-00', [
							'id' => 'phone',
							'class' => 'form-control',
							'label' => [
								'text' => __('Telephone mask'),
								'class' => 'form-label'
							],
						]) ?>
					</div>

					<!-- Toggle switches -->
					<div class="col-12">
						<div class="form-label"><?= __('Toggle switches') ?></div>
						<div class="d-flex flex-column gap-2">
							<?= $this->KvForm->switch('option_1', ['label' => __('Option 1'), 'size' => '3', 'checked' => true]) ?>
							<?= $this->KvForm->switch('option_2', ['label' => __('Option 2'), 'size' => '2', 'checked' => false]) ?>
							<?= $this->KvForm->switch('option_3', ['label' => __('Option 3'), 'size' => '2', 'checked' => true]) ?>
						</div>
					</div>
				</div>

			</div> <!-- /#tabs-datesheet -->

			<!-- 2. További adatok fül -->
			<div class="tab-pane fade" id="tabs-biography" role="tabpanel">
				<div class="row g-3">

					<div class="col-12">
						<?= $this->Form->control('bio', [
							'type' => 'textarea',
							'id' => 'hugerte-bio',
							'label' => false, //['text' => __('Bio'), 'class' => 'form-label'],
							'class' => 'form-control hugerte-editor',
							'rows' => 15,
							'value' => 'Big belly rude boy, million dollar hustler. Unemployed.',
						]) ?>
					</div>
				</div>
			</div> <!-- /#tabs-biography -->

			<!-- 3. Beállítások fül -->
			<div class="tab-pane fade" id="tabs-settings" role="tabpanel">
				<div class="mb-3">
					<h4 class="card-title mb-1"><?= __('Beállítások') ?></h4>
					<div class="text-secondary small"><?= __('Itt állítható a megjelenés és az alapértelmezett sorrend.') ?></div>
				</div>

				<div class="row g-3">
					<!-- Láthatóság -->
					<div class="col-12">
						<div class="col-sm-6 col-md-4">
							<label class="form-label"><?= __('Visible') ?></label>
							<div class="pt-2">
								<?= $this->KvForm->switch('visible', [
									'label' => __('Aktív / Látható'),
									'size' => '3',
									'checked' => true
								]) ?>
							</div>
						</div>
					</div>

					<!-- Pozíció Spinner -->
					<div class="col-12">
						<div class="col-sm-6 col-md-4">
							<?= $this->KvForm->numberSpinner('pos', [
								'label' => ['text' => __('Position')],
								'min' => -10000,
								'max' => 10000,
								'step' => '1',
								'value' => '1000'
							]) ?>
						</div>
					</div>
				</div>
			</div> <!-- /#tabs-settings -->

        </div> <!-- /.tab-content -->
    </div> <!-- /.card-body -->

    <div class="card-footer text-start">
		<!-- Mentés gomb -->
		<?= $this->KvForm->saveButton() ?>

		<!-- Mégse gomb: visszatér a jelenlegi controller index() akciójára -->
		<?= $this->KvForm->cancelButton() ?>
    </div>

    <?= $this->Form->end() ?>
</div>

<?php
$this->Html->css([
    'KvAdmin./vendor/tom-select/css/tom-select.bootstrap5.min',
    'KvAdmin./vendor/flatpickr/dist/flatpickr.min',
], ['block' => 'css']);

$this->Html->script([
    'KvAdmin./vendor/tom-select/js/tom-select.complete.min',
    'KvAdmin./vendor/imask/dist/imask.min',
    'KvAdmin./vendor/hugerte/hugerte.min',
    'KvAdmin./vendor/flatpickr/dist/flatpickr.min',
    'KvAdmin./vendor/flatpickr/dist/l10n/hu',
], ['block' => 'script']);
?>

<?php
$this->Html->scriptBlock(
    "
    document.addEventListener('DOMContentLoaded', function () {
        
        // 1. Telefon maszkolás (Vanilla IMask)
        const phoneElem = document.getElementById('phone');
        if (phoneElem && typeof IMask !== 'undefined') {
            IMask(phoneElem, { mask: '+{36} 00/000-00-00' });
        }

		// 1. Sima (egyszeres) Select: valódi natív select hatás
		document.querySelectorAll('.tom-select:not(.multi-select)').forEach(function (element) {
			if (!element.tomselect && typeof TomSelect !== 'undefined') {
				new TomSelect(element, {
					copyClassesToDropdown: false,
					create: false,
					allowEmptyOption: true,
					maxOptions: null,
					openOnFocus: true,
					wrapperClass: 'ts-wrapper form-select single'
				});
			}
		});

		// Többes választó (Tags / Multi-select)
		document.querySelectorAll('.tom-select.multi-select').forEach(function (element) {
			if (!element.tomselect && typeof TomSelect !== 'undefined') {
				new TomSelect(element, {
					plugins: {
						'remove_button': { 
							title: 'Eltávolítás' 
						},
						'clear_button': { 
							title: 'Összes törlése' 
						}
					},
					persist: false,
					create: false,
					mode: 'multi',
					copyClassesToDropdown: false,
					wrapperClass: 'ts-wrapper form-select multi'
				});
			}
		});		
		
        // 4. HugeRTE szerkesztő
		if (typeof hugerte !== 'undefined') {
			const isDarkMode = document.body.getAttribute('data-bs-theme') === 'dark';

			hugerte.init({
				selector: '#hugerte-bio',
				height: 600,
				menubar: 'file edit view insert format tools table help',
				statusbar: true,
				promotion: false,
				branding: false,
				
				plugins: [
					'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
					'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
					'insertdatetime', 'media', 'table', 'help', 'wordcount', 'codesample'
				],

				toolbar: [
					'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | removeformat',
					'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table link image media codesample | code preview fullscreen'
				],

				/* Alapértelmezett betűkészlet: Arial 14px, tiszta felső margóval és térközökkel */
				content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; line-height: 1.5; color: ' + (isDarkMode ? '#f8fafc' : '#1e293b') + '; background-color: ' + (isDarkMode ? '#1b2431' : '#ffffff') + '; padding: 0.4375rem 0.75rem; margin: 0; } body > *:first-child { margin-top: 0 !important; } p { margin: 0 0 0.5rem 0; }',
				font_family_formats: 'Arial=Arial,Helvetica,sans-serif; Segoe UI=Segoe UI,Roboto,Helvetica,sans-serif; Courier New=courier new,courier,monospace; Georgia=georgia,palatino; Times New Roman=times new roman,times;',
				font_size_formats: '10px 12px 14px 16px 18px 24px 36px',
				skin: isDarkMode ? 'oxide-dark' : 'oxide',
				content_css: isDarkMode ? 'dark' : 'default',

				setup: function (editor) {
					editor.on('change keyup paste', function () {
						editor.save();
					});

					/* Betöltéskor biztosítja az Arial és 14px formátumot */
					editor.on('init', function () {
						editor.getDoc().body.style.fontFamily = 'Arial, sans-serif';
						editor.getDoc().body.style.fontSize = '14px';
					});
				}
			});

			const tabTrigger = document.querySelector('a[href=\"#tabs-biography\"], button[data-bs-target=\"#tabs-biography\"]');
			if (tabTrigger) {
				tabTrigger.addEventListener('shown.bs.tab', function () {
					const editor = hugerte.get('hugerte-bio');
					if (editor) {
						editor.execCommand('mceRepaint');
					}
				});
			}
		}
		
	

        // 5. Flatpickr Dátum & Idő (Magyar lokalizáció)
        if (typeof flatpickr !== 'undefined') {
            flatpickr('.flatpickr-datetime', {
                locale: 'hu',
                enableTime: true,
                time_24hr: true,
                dateFormat: 'Y-m-d H:i:S',
                altInput: true,
                altFormat: 'Y.m.d. H:i',
                allowInput: true,
                disableMobile: true
            });

            flatpickr('.flatpickr-date', {
                locale: 'hu',
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'Y.m.d.',
                allowInput: true,
                disableMobile: true
            });

            flatpickr('.flatpickr-time', {
                locale: 'hu',
                enableTime: true,
                noCalendar: true,
                time_24hr: true,
                dateFormat: 'H:i:S',
                altInput: true,
                altFormat: 'H:i',
                allowInput: true,
                disableMobile: true
            });
        }

        // 6. Number Spinner gombok (Tiszta Vanilla JS esemény delegálás)
        document.body.addEventListener('click', function (e) {
            const button = e.target.closest('.input-group [data-action]');
            if (!button) return;

            const group = button.closest('.input-group');
            const input = group ? group.querySelector('input[type=\"number\"]') : null;
            if (!input) return;

            const stepStr = input.step && input.step !== 'any' ? input.step : '1';
            const step = parseFloat(stepStr) || 1;
            const min = input.min !== '' ? parseFloat(input.min) : -Infinity;
            const max = input.max !== '' ? parseFloat(input.max) : Infinity;
            let currentVal = parseFloat(input.value) || 0;

            const decimals = stepStr.includes('.') ? stepStr.split('.')[1].length : 0;

            if (button.dataset.action === 'increment') {
                currentVal = Math.min(max, currentVal + step);
            } else if (button.dataset.action === 'decrement') {
                currentVal = Math.max(min, currentVal - step);
            }

            input.value = currentVal.toFixed(decimals);
            input.dispatchEvent(new Event('change', { bubbles: true }));
            input.dispatchEvent(new Event('input', { bubbles: true }));
        });

    });
    ",
    ['block' => 'footer']
);
?>