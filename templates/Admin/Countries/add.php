<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Country $country
 * @var \Cake\Collection\CollectionInterface|string[] $continents
 */
?>
<div class="page-header d-print-none mb-3 countries">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('Új {0} felvitele', __('Country')) ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="card countries">
    <?= $this->Form->create($country) ?>

    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <?= $this->Html->link(__('Datasheet'), '#tabs-datesheet', ['class' => 'nav-link active', 'data-bs-toggle' => 'tab', 'aria-selected' => 'true', 'role' => 'tab']) ?>
            </li>


            <li class="nav-item ms-auto" role="presentation">
                <?= $this->Html->link($this->Icon->render('settings', ['class' => 'stroke-thin']), '#tabs-settings', ['escape' => false, 'class' => 'nav-link', 'data-bs-toggle' => 'tab', 'title' => __('Settings'), 'aria-selected' => 'false', 'role' => 'tab', 'tabindex' => '-1']) ?>
            </li>
        </ul>
    </div>

    <div class="card-body pb-4">
        <div class="tab-content">

            <!-- 1. Datasheet TAB -->
            <div class="tab-pane fade show active" id="tabs-datesheet" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('continent_id', [
                            'options' => $continents,
                            'label' => ['text' => __('Continent Id'), 'class' => 'form-label'],
                            'class' => 'form-select tom-select',
                            'empty' => __('Please select...'),
                            'required' => true
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('iso2', ['label' => ['text' => __('Iso2'), 'class' => 'form-label'], 'class' => 'form-control', 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('name', ['label' => ['text' => __('Name'), 'class' => 'form-label'], 'class' => 'form-control', 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('endonim_name', ['label' => ['text' => __('Endonim Name'), 'class' => 'form-label'], 'class' => 'form-control', 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('locale', ['label' => ['text' => __('Locale'), 'class' => 'form-label'], 'class' => 'form-control', 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('timezone', ['label' => ['text' => __('Timezone'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('phone_prefix', ['label' => ['text' => __('Phone Prefix'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('logo', ['label' => ['text' => __('Logo'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('currency', ['label' => ['text' => __('Currency'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->KvForm->numberSpinner('club_count', [
                            'label' => ['text' => __('Club Count')],
                            'min' => 0,
                            'max' => 4294967295,
                            'step' => '1',
                            'value' => '', 'required' => true
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->KvForm->numberSpinner('setup_count', [
                            'label' => ['text' => __('Setup Count')],
                            'min' => 0,
                            'max' => 4294967295,
                            'step' => '1',
                            'value' => '0'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->KvForm->numberSpinner('user_count', [
                            'label' => ['text' => __('User Count')],
                            'min' => 0,
                            'step' => '1',
                            'value' => '0'
                        ]) ?>
                    </div>

                </div>
            </div> <!-- /#tabs-datesheet -->


            <!-- 3. Settings TAB -->
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
                                <?= $this->KvForm->switch('visible', ['label' => __('Active / Visible'), 'size' => '3', 'checked' => true]) ?>
                            </div>
                        </div>
                    </div>
                    <!-- Pozíció Spinner -->
                    <div class="col-12">
                        <div class="col-sm-6 col-md-4">
                            <?= $this->KvForm->numberSpinner('pos', ['label' => ['text' => __('Position')], 'min' => -10000, 'max' => 10000, 'step' => '1', 'value' => '1000']) ?>
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

        // 2. Sima (egyszeres) Select: valódi natív select hatás
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

        // 3. Többes választó (Tags / Multi-select)
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

            document.querySelectorAll('.hugerte-editor').forEach(function (editorElement) {
                hugerte.init({
                    target: editorElement,
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
                    content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; line-height: 1.5; color: ' + (isDarkMode ? '#f8fafc' : '#1e293b') + '; background-color: ' + (isDarkMode ? '#1b2431' : '#ffffff') + '; padding: 0.4375rem 0.75rem; margin: 0; } body > *:first-child { margin-top: 0 !important; } p { margin: 0 0 0.5rem 0; }',
                    font_family_formats: 'Arial=Arial,Helvetica,sans-serif; Segoe UI=Segoe UI,Roboto,Helvetica,sans-serif; Courier New=courier new,courier,monospace; Georgia=georgia,palatino; Times New Roman=times new roman,times;',
                    font_size_formats: '10px 12px 14px 16px 18px 24px 36px',
                    skin: isDarkMode ? 'oxide-dark' : 'oxide',
                    content_css: isDarkMode ? 'dark' : 'default',
                    setup: function (editor) {
                        editor.on('change keyup paste', function () {
                            editor.save();
                        });
                        editor.on('init', function () {
                            editor.getDoc().body.style.fontFamily = 'Arial, sans-serif';
                            editor.getDoc().body.style.fontSize = '14px';
                        });
                    }
                });
            });

            // Bootstrap fülváltáskor az editor újrarajzolása
            document.querySelectorAll('a[data-bs-toggle=\"tab\"]').forEach(function (tabEl) {
                tabEl.addEventListener('shown.bs.tab', function () {
                    document.querySelectorAll('.hugerte-editor').forEach(function (el) {
                        const editor = hugerte.get(el.id);
                        if (editor) {
                            editor.execCommand('mceRepaint');
                        }
                    });
                });
            });
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

        // 6. Number Spinner gombok
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