<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var string[]|\Cake\Collection\CollectionInterface $cities
 * @var string[]|\Cake\Collection\CollectionInterface $clubs
 * @var string[]|\Cake\Collection\CollectionInterface $competitions
 */
?>
<div class="page-header d-print-none mb-3 users">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('{0} módosítása', __('User')) ?></h2>
        </div>
        <div class="col-auto ms-auto">
            <?= $this->Html->link($this->Icon->outline('x'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-icon btn-action-default btn-smooth-rotate', 'data-bs-toggle' => 'tooltip', 'title' => __('Vissza a listához')]) ?>
        </div>
    </div>
</div>

<div class="card users">
    <?= $this->Form->create($user) ?>

    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <?= $this->Html->link(__('Datasheet'), '#tabs-datesheet', ['class' => 'nav-link active', 'data-bs-toggle' => 'tab', 'aria-selected' => 'true', 'role' => 'tab']) ?>
            </li>

            <li class="nav-item" role="presentation">
                <?= $this->Html->link(__('Additional Data'), '#tabs-additional_data', ['class' => 'nav-link', 'data-bs-toggle' => 'tab', 'aria-selected' => 'false', 'role' => 'tab', 'tabindex' => '-1']) ?>
            </li>

        </ul>
    </div>

    <div class="card-body pb-4">
        <div class="tab-content">

            <!-- 1. Datasheet TAB -->
            <div class="tab-pane fade show active" id="tabs-datesheet" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('city_id', [
                            'options' => $cities,
                            'label' => ['text' => __('City Id'), 'class' => 'form-label'],
                            'class' => 'form-select tom-select',
                            'empty' => '',
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('club_id', [
                            'options' => $clubs,
                            'label' => ['text' => __('Club Id'), 'class' => 'form-label'],
                            'class' => 'form-select tom-select',
                            'empty' => '',
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('username', ['label' => ['text' => __('Username'), 'class' => 'form-label'], 'class' => 'form-control', 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('email', ['label' => ['text' => __('Email'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('password', ['label' => ['text' => __('Password'), 'class' => 'form-label'], 'class' => 'form-control', 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('first_name', ['label' => ['text' => __('First Name'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('last_name', ['label' => ['text' => __('Last Name'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('phone', ['label' => ['text' => __('Phone'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('avatar', ['label' => ['text' => __('Avatar'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('token', ['label' => ['text' => __('Token'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->KvForm->dateTimePicker('token_expires', ['label' => ['text' => __('Token Expires')]]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('api_token', ['label' => ['text' => __('Api Token'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->KvForm->dateTimePicker('activation_date', ['label' => ['text' => __('Activation Date')]]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('secret', ['label' => ['text' => __('Secret'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label"><?= __('Secret Verified') ?></div>
                        <?= $this->KvForm->switch('secret_verified', ['label' => __('Secret Verified')]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->KvForm->dateTimePicker('tos_date', ['label' => ['text' => __('Tos Date')]]) ?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label"><?= __('Active') ?></div>
                        <?= $this->KvForm->switch('active', ['label' => __('Active')]) ?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label"><?= __('Enabled') ?></div>
                        <?= $this->KvForm->switch('enabled', ['label' => __('Enabled')]) ?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label"><?= __('Is Superuser') ?></div>
                        <?= $this->KvForm->switch('is_superuser', ['label' => __('Is Superuser')]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('role', ['label' => ['text' => __('Role'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('membership_status', ['label' => ['text' => __('Membership Status'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->KvForm->datePicker('membership_joined_date', ['label' => ['text' => __('Membership Joined Date')]]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->KvForm->datePicker('club_membership_fee_date', ['label' => ['text' => __('Club Membership Fee Date')]]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->KvForm->datePicker('national_membership_fee_date', ['label' => ['text' => __('National Membership Fee Date')]]) ?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label"><?= __('Application Notified') ?></div>
                        <?= $this->KvForm->switch('application_notified', ['label' => __('Application Notified')]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->KvForm->dateTimePicker('last_login', ['label' => ['text' => __('Last Login')]]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->KvForm->dateTimePicker('lockout_time', ['label' => ['text' => __('Lockout Time')]]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('login_token', ['label' => ['text' => __('Login Token'), 'class' => 'form-label'], 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->KvForm->dateTimePicker('login_token_date', ['label' => ['text' => __('Login Token Date')]]) ?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label"><?= __('Token Send Requested') ?></div>
                        <?= $this->KvForm->switch('token_send_requested', ['label' => __('Token Send Requested')]) ?>
                    </div>

                    <!-- competitions (Többes választás) -->
                    <div class="col-md-6">
                        <?= $this->Form->control('competitions._ids', [
                            'options' => $competitions,
                            'type' => 'select',
                            'multiple' => true,
                            'label' => ['text' => __('Competitions input'), 'class' => 'form-label'],
                            'class' => 'form-select tom-select multi-select',
                            'empty' => false
                        ]) ?>
                    </div>
                </div>
            </div> <!-- /#tabs-datesheet -->

            <!-- 2. További adatok fül: additional_data -->
            <div class="tab-pane fade" id="tabs-additional_data" role="tabpanel">
                <div class="row g-3">
                    <div class="col-12">
                        <?= $this->Form->control('additional_data', [
                            'type' => 'textarea',
                            'id' => 'hugerte-additional_data',
                            'label' => false,
                            'class' => 'form-control hugerte-editor',
                            'rows' => 14,
                        ]) ?>
                    </div>
                </div>
            </div> <!-- /#tabs-additional_data -->


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
        const requiredSelectMessage = " . json_encode(__('This field cannot be left empty')) . ";
        document.querySelectorAll('.tom-select:not(.multi-select)').forEach(function (element) {
            if (!element.tomselect && typeof TomSelect !== 'undefined') {
                const selectedOption = element.querySelector('option[selected]');
                const selectedValue = selectedOption && selectedOption.value !== '' ? selectedOption.value : '';
                const tomSelect = new TomSelect(element, {
                    copyClassesToDropdown: false,
                    create: false,
                    allowEmptyOption: true,
                    maxOptions: null,
                    openOnFocus: true,
                    placeholder: '',
                    items: selectedValue ? [selectedValue] : [],
                    wrapperClass: 'ts-wrapper form-select single'
                });

                const setEmptyNativeValue = function () {
                    Array.from(element.options).forEach(function (option) {
                        option.selected = option.value === '';
                    });
                    element.value = '';
                };

                const toggleRequiredState = function (value) {
                    if (!element.required) {
                        return;
                    }
                    const isEmpty = !value;
                    tomSelect.wrapper.classList.toggle('is-invalid', isEmpty);
                    let feedback = tomSelect.wrapper.parentElement.querySelector('.invalid-feedback.tom-select-required');
                    if (isEmpty) {
                        if (!feedback) {
                            feedback = document.createElement('div');
                            feedback.className = 'invalid-feedback tom-select-required d-block';
                            feedback.textContent = requiredSelectMessage;
                            tomSelect.wrapper.after(feedback);
                        }
                    } else if (feedback) {
                        feedback.remove();
                    }
                };

                tomSelect.on('change', function (value) {
                    if (!value) {
                        setEmptyNativeValue();
                    }
                    toggleRequiredState(value);
                });

                if (!selectedValue) {
                    tomSelect.clear(true);
                    setEmptyNativeValue();
                }

                const form = element.closest('form');
                if (form && !form.dataset.tomSelectRequired) {
                    form.dataset.tomSelectRequired = '1';
                    form.addEventListener('submit', function (event) {
                        let firstInvalid = null;
                        form.querySelectorAll('select.tom-select[required]:not(.multi-select)').forEach(function (select) {
                            const ts = select.tomselect;
                            const value = ts ? ts.getValue() : select.value;
                            if (!value) {
                                event.preventDefault();
                                if (ts) {
                                    ts.wrapper.classList.add('is-invalid');
                                    let feedback = ts.wrapper.parentElement.querySelector('.invalid-feedback.tom-select-required');
                                    if (!feedback) {
                                        feedback = document.createElement('div');
                                        feedback.className = 'invalid-feedback tom-select-required d-block';
                                        feedback.textContent = requiredSelectMessage;
                                        ts.wrapper.after(feedback);
                                    }
                                    if (!firstInvalid) {
                                        firstInvalid = ts;
                                    }
                                }
                            }
                        });
                        if (firstInvalid) {
                            firstInvalid.focus();
                            firstInvalid.open();
                        }
                    });
                }
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