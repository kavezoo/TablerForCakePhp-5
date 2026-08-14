<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 * @var \Cake\Collection\CollectionInterface|string[] $countries
 * @var \Cake\Collection\CollectionInterface|string[] $counties
 */
$this->assign('title', __('Város hozzáadása'));
?>

<div class="page-header d-print-none mb-3">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= __('Település módosítása') ?></h2>
        </div>

        <div class="col-auto ms-auto">
            <?= $this->Html->link(
                $this->Icon->outline('x'),
                ['action' => 'index'],
                [
                    'escape' => false,
                    'class' => 'btn btn-icon btn-action-default btn-smooth-rotate',
                    'data-bs-toggle' => 'tooltip',
                    'data-bs-placement' => 'top',
                    'title' => __('Vissza a listához')
                ]
            ) ?>
        </div>
    </div>
</div>

<div class="card">
    <?= $this->Form->create($city) ?>
    
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <?= $this->Html->link(
                    __('Alapadatok'),
                    '#tabs-home-1',
                    [
                        'class' => 'nav-link active',
                        'data-bs-toggle' => 'tab',
                        'aria-selected' => 'true',
                        'role' => 'tab'
                    ]
                ) ?>
            </li>
            <li class="nav-item" role="presentation">
                <?= $this->Html->link(
                    __('További adatok'),
                    '#tabs-profile-1',
                    [
                        'class' => 'nav-link',
                        'data-bs-toggle' => 'tab',
                        'aria-selected' => 'false',
                        'role' => 'tab',
                        'tabindex' => '-1'
                    ]
                ) ?>
            </li>
            <li class="nav-item ms-auto" role="presentation">
                <?= $this->Html->link(
                    $this->Icon->render('settings', ['class' => 'stroke-thin']),                    
                    '#tabs-settings-1',
                    [
                        'escape' => false,
                        'class' => 'nav-link',
                        'data-bs-toggle' => 'tab',
                        'data-bs-placement' => 'top',
                        'title' => __('Settings'),
                        'aria-selected' => 'false',
                        'role' => 'tab',
                        'tabindex' => '-1'
                    ]
                ) ?>
            </li>
        </ul>
    </div>    

    <div class="card-body pb-4">
        
        <!-- TAB FÜLEK TARTALMA (Tab Content) -->
        <div class="tab-content">
            
            <!-- 1. Alapadatok fül tartalma -->
            <div class="tab-pane fade show active" id="tabs-home-1" role="tabpanel">
                
                <div class="row g-3 mb-3">
                    <!-- Dátum és Idő beviteli mező -->
                    <div class="col-md-4">
                        <?= $this->Form->control('published_at', [
                            'type' => 'text',
                            'label' => ['text' => __('Dátum és időpont'), 'class' => 'form-label'],
                            'class' => 'form-control flatpickr-datetime',
                            'value' => $this->Form->getSourceValue('published_at') ?? '2025-12-25 14:00',
                            'placeholder' => 'ÉÉÉÉ.HH.NN ÓÓ:PP',
                            'autocomplete' => 'off',
                            'templates' => [
                                'inputContainer' => '<div>{{content}}</div>',
                                'formGroup' => '{{label}}<div class="input-icon"><span class="input-icon-addon">' . $this->Icon->outline('calendar-time') . '</span>{{input}}</div>',
                            ],
                        ]) ?>
                    </div>

                    <!-- Csak Dátum beviteli mező -->
                    <div class="col-md-4">
                        <?= $this->Form->control('event_date', [
                            'type' => 'text',
                            'label' => ['text' => __('Dátum'), 'class' => 'form-label'],
                            'class' => 'form-control flatpickr-date',
                            'placeholder' => 'ÉÉÉÉ.HH.NN',
                            'autocomplete' => 'off',
                            'templates' => [
                                'inputContainer' => '<div>{{content}}</div>',
                                'formGroup' => '{{label}}<div class="input-icon"><span class="input-icon-addon">' . $this->Icon->outline('calendar') . '</span>{{input}}</div>',
                            ],
                        ]) ?>
                    </div>

                    <!-- Csak Idő beviteli mező -->
                    <div class="col-md-4">
                        <?= $this->Form->control('event_time', [
                            'type' => 'text',
                            'label' => ['text' => __('Időpont'), 'class' => 'form-label'],
                            'class' => 'form-control flatpickr-time',
                            'placeholder' => 'ÓÓ:PP',
                            'autocomplete' => 'off',
                            'templates' => [
                                'inputContainer' => '<div>{{content}}</div>',
                                'formGroup' => '{{label}}<div class="input-icon"><span class="input-icon-addon">' . $this->Icon->outline('clock') . '</span>{{input}}</div>',
                            ],
                        ]) ?>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <label class="form-label"><?= __('Select') ?></label>
                        <div>
                            <select class="form-select">
                                <option><?= __('Option 1') ?></option>
                                <optgroup label="Optgroup 1">
                                    <option><?= __('Option 1') ?></option>
                                    <option><?= __('Option 2') ?></option>
                                </optgroup>
                                <optgroup label="Optgroup 2">
                                    <option><?= __('Option 1') ?></option>
                                    <option><?= __('Option 2') ?></option>
                                </optgroup>
                                <optgroup label="Optgroup 3">
                                    <option><?= __('Option 1') ?></option>
                                    <option><?= __('Option 2') ?></option>
                                </optgroup>
                                <option><?= __('Option 3') ?></option>
                                <option><?= __('Option 4') ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label"><?= __('Leírás / Tartalom') ?></label>
                        <textarea id="editor" name="body">Hello, <b>Tabler</b>!</textarea>
                    </div>
                </div>

            </div>

            <!-- 2. További adatok fül tartalma -->
            <div class="tab-pane fade" id="tabs-profile-1" role="tabpanel">                
                <div class="row g-3">
                    
                    <div class="col-12">
                        <?= $this->Form->control('phone', [
                            'type' => 'text',
                            'label' => ['text' => __('Telephone mask'), 'class' => 'form-label'],
                            'id' => 'phone',
                            'class' => 'form-control',
                            'data-mask' => '+36 00/000-00-00',
                            'data-mask-visible' => 'true',
                            'placeholder' => '+36 00/000-00-00',
                            'autocomplete' => 'off'
                        ]) ?>
                    </div>

                    <div class="col-12">
                        <div class="form-label"><?= __('Toggle switches') ?></div>
                        <div class="d-flex flex-column gap-2">
                            <!-- Option 1 (Bejelölve) -->
                            <label class="form-check form-switch form-switch-3 mb-0">
                                <?= $this->Form->checkbox('option_1', [
                                    'class' => 'form-check-input',
                                    'checked' => true,
                                    'templates' => [
                                        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>'
                                    ]
                                ]) ?>
                                <span class="form-check-label"><?= __('Option 1') ?></span>
                            </label>

                            <!-- Option 2 -->
                            <label class="form-check form-switch form-switch-2 mb-0">
                                <?= $this->Form->checkbox('option_2', [
                                    'class' => 'form-check-input',
                                    'checked' => false,
                                    'templates' => [
                                        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>'
                                    ]
                                ]) ?>
                                <span class="form-check-label"><?= __('Option 2') ?></span>
                            </label>

                            <!-- Option 3 -->
                            <label class="form-check form-switch form-switch-2 mb-0">
                                <?= $this->Form->checkbox('option_3', [
                                    'class' => 'form-check-input',
                                    'checked' => true,
                                    'templates' => [
                                        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>'
                                    ]
                                ]) ?>
                                <span class="form-check-label"><?= __('Option 3') ?></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <?= $this->Form->control('tags', [
                            'type' => 'select',
                            'multiple' => true,
                            'label' => ['text' => __('Tags input'), 'class' => 'form-label'],
                            'id' => 'select-tags',
                            'class' => 'form-select',
                            'options' => [
                                'JavaScript' => 'JavaScript',
                                'jQuery' => 'jQuery',
                                'Ruby' => 'Ruby',
                                'HTML' => 'HTML',
                                'Bootstrap' => 'Bootstrap',
                                'CSS' => 'CSS',
                                'Python' => 'Python',
                            ],
                            'empty' => false,
                        ]) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->Form->control('name', [
                            'label' => ['text' => __('Name'), 'class' => 'form-label'],
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('zip', [
                            'label' => ['text' => __('Zip'), 'class' => 'form-label'],
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('shortname', [
                            'label' => ['text' => __('Short name'), 'class' => 'form-label'],
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
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

                    <div class="col-12">
                        <label class="form-label"><?= __('Bio') ?></label>
                        <?= $this->Form->textarea('bio', [
                            'class' => 'form-control',
                            'rows' => 5,
                            'value' => 'Big belly rude boy, million dollar hustler. Unemployed.'
                        ]) ?>
                    </div>
                    
                    <div class="col-md-3">
                        <?= $this->Form->control('lat', [
                            'label' => ['text' => __('Szélesség (Lat)'), 'class' => 'form-label'],
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('lng', [
                            'label' => ['text' => __('Hosszúság (Lng)'), 'class' => 'form-label'],
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('lat2', [
                            'label' => ['text' => __('Lat 2'), 'class' => 'form-label'],
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('lng2', [
                            'label' => ['text' => __('Lng 2'), 'class' => 'form-label'],
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                </div>
            </div>

            <!-- 3. Beállítások fül tartalma -->
            <div class="tab-pane fade" id="tabs-settings-1" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-3">
                        <?= $this->Form->control('visible', [
                            'label' => ['text' => __('Láthatóság'), 'class' => 'form-label'],
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('pos', [
                            'label' => ['text' => __('Pozíció'), 'class' => 'form-label'],
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                </div>
            </div>

        </div>        
        
    </div>
    
	<div class="card-footer text-start">
		<?= $this->Form->button(
			$this->Icon->outline('cloud-upload', ['class' => 'icon btn-icon-adjust']) . ' ' . __('Save'),
			[
				'type' => 'submit',
				'escapeTitle' => false,
				'class' => 'btn btn-outline-secondary btn-animate-icon btn-animate-icon-rotate d-inline-flex align-items-center gap-2'
			]
		) ?>
	</div>

    <?= $this->Form->end() ?>
</div>

<?php
    $this->Html->css([
        '/vendor/tom-select/tom-select.default.min',
        '/vendor/flatpickr/dist/flatpickr.min',
    ], ['block' => 'css']);
    
    $this->Html->script([
        '/vendor/tom-select/tom-select.complete',
        '/vendor/imask/dist/imask.min',
        '/vendor/hugerte/hugerte.min',
        '/vendor/flatpickr/dist/flatpickr.min',
        '/vendor/flatpickr/dist/l10n/hu',
    ], ['block' => 'script']);
?>

<?php
$this->Html->scriptBlock(
    "
    document.addEventListener('DOMContentLoaded', function () {
        
        // 1. Telefon maszkolás
        const phoneElem = document.getElementById('phone');
        if (phoneElem && typeof IMask !== 'undefined') {
            IMask(phoneElem, { mask: '+{36} 00/000-00-00' });
        }

        // 2. TomSelect Tag-ek
        const tagsElem = document.getElementById('select-tags');
        if (tagsElem && typeof TomSelect !== 'undefined') {
            new TomSelect(tagsElem, { maxItems: 3 });
        }

        // 3. HugeRTE szerkesztő
        if (document.getElementById('editor') && typeof hugerte !== 'undefined') {
            hugerte.init({
                height: 350,
                selector: '#editor',
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
                    'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
                ],
                toolbar: 'undo redo | bold italic underline | forecolor backcolor | alignright alignjustify | bullist numlist outdent indent | link image | removeformat | code'
            });
        }

        // 4. Flatpickr Dátum & Idő
        if (typeof flatpickr !== 'undefined') {
            flatpickr('.flatpickr-datetime', {
                locale: 'hu',
                enableTime: true,
                time_24hr: true,
                dateFormat: 'Y-m-d H:i:m',
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
                dateFormat: 'H:i:m',
                altInput: true,
                altFormat: 'H:i',
                allowInput: true,
                disableMobile: true
            });
        }

    });
    ",
    ['block' => 'footer']
);
?>