<?php
declare(strict_types=1);

namespace KvAdmin\View\Helper;

use Cake\I18n\DateTime;
use Cake\View\Helper;

/**
 * @property \Cake\View\Helper\FormHelper $Form
 * @property \Cake\View\Helper\HtmlHelper $Html
 * @property \App\View\Helper\IconHelper $Icon
 */
class KvFormHelper extends Helper
{
    protected array $helpers = ['Form', 'Html', 'Icon'];

    /**
     * Dátum és időpont választó
     */
    public function dateTimePicker(string $fieldName, array $options = []): string
    {
        return $this->buildPicker(
            $fieldName,
            'flatpickr-datetime',
            'calendar-time',
            'yyyy-MM-dd HH:mm:ss',
            'ÉÉÉÉ.HH.NN ÓÓ:PP',
            $options
        );
    }

    /**
     * Csak dátum választó
     */
    public function datePicker(string $fieldName, array $options = []): string
    {
        return $this->buildPicker(
            $fieldName,
            'flatpickr-date',
            'calendar',
            'yyyy-MM-dd',
            'ÉÉÉÉ.HH.NN',
            $options
        );
    }

    /**
     * Csak idő választó
     */
    public function timePicker(string $fieldName, array $options = []): string
    {
        return $this->buildPicker(
            $fieldName,
            'flatpickr-time',
            'clock',
            'HH:mm:ss',
            'ÓÓ:PP',
            $options
        );
    }

    /**
     * Number Spinner léptető (+ / - gombokkal)
     */
    public function numberSpinner(string $fieldName, array $options = []): string
    {
        $maxWidth = $options['maxWidth'] ?? '200px';
        $label = $options['label'] ?? null;
        unset($options['maxWidth'], $options['label']);

        $defaultOptions = [
            'type' => 'number',
            'label' => false,
            'class' => 'form-control text-center',
            'templates' => [
                'inputContainer' => '{{content}}',
                'inputContainerError' => '{{content}}{{error}}',
            ],
            'min' => 0,
            'max' => 10000,
            'step' => '1',
        ];
        $inputOptions = array_merge($defaultOptions, $options);

        $btnMinus = $this->Form->button(
            $this->Icon->render('minus'),
            [
                'type' => 'button',
                'class' => 'btn btn-outline-secondary btn-icon',
                'data-action' => 'decrement',
                'escapeTitle' => false,
            ]
        );

        $btnPlus = $this->Form->button(
            $this->Icon->render('plus'),
            [
                'type' => 'button',
                'class' => 'btn btn-outline-secondary btn-icon',
                'data-action' => 'increment',
                'escapeTitle' => false,
            ]
        );

        $controlHtml = $this->Form->control($fieldName, $inputOptions);

        $groupHtml = sprintf(
            '<div class="input-group" style="max-width: %s;">%s%s%s</div>',
            h($maxWidth),
            $btnMinus,
            $controlHtml,
            $btnPlus
        );

        if ($label !== false && $label !== null) {
            $labelText = is_array($label) ? ($label['text'] ?? '') : $label;
            $labelClass = is_array($label) ? ($label['class'] ?? 'form-label') : 'form-label';
            $labelHtml = sprintf('<label class="%s">%s</label>', h($labelClass), h($labelText));

            return '<div>' . $labelHtml . $groupHtml . '</div>';
        }

        return $groupHtml;
    }

    /**
     * Tabler Kapcsoló (Switch)
     */
    public function switch(string $fieldName, array $options = []): string
    {
        $label = $options['label'] ?? '';
        $size = isset($options['size']) ? ' form-switch-' . $options['size'] : '';
        $checked = $options['checked'] ?? false;
        unset($options['label'], $options['size'], $options['checked']);

        $checkboxHtml = $this->Form->checkbox($fieldName, array_merge([
            'class' => 'form-check-input',
            'checked' => $checked,
            'templates' => [
                'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            ],
        ], $options));

        return sprintf(
            '<label class="form-check form-switch%s mb-0">%s<span class="form-check-label">%s</span></label>',
            h($size),
            $checkboxHtml,
            h((string)$label)
        );
    }

    /**
     * Maszkolt mező
     */
    public function maskedInput(string $fieldName, string $mask, array $options = []): string
    {
        $defaults = [
            'type' => 'text',
            'class' => 'form-control',
            'data-mask' => $mask,
            'data-mask-visible' => 'true',
            'placeholder' => $mask,
            'autocomplete' => 'off',
            'label' => ['class' => 'form-label'],
        ];

        return $this->Form->control($fieldName, array_merge($defaults, $options));
    }

    /**
     * Közös Flatpickr picker felépítő
     */
    protected function buildPicker(
        string $fieldName,
        string $pickerClass,
        string $iconName,
        string $dateFormat,
        string $placeholder,
        array $options
    ): string {
        $entity = $this->Form->getSourceValue($fieldName);
        $formattedValue = null;

        if ($entity instanceof DateTime || $entity instanceof \DateTimeInterface) {
            $formattedValue = $entity->format(str_replace(['yyyy', 'MM', 'dd', 'HH', 'mm', 'ss'], ['Y', 'm', 'd', 'H', 'i', 's'], $dateFormat));
        }

        $defaults = [
            'type' => 'text',
            'class' => 'form-control ' . $pickerClass,
            'placeholder' => $placeholder,
            'autocomplete' => 'off',
            'label' => ['class' => 'form-label'],
            'templates' => [
                'inputContainer' => '<div>{{content}}</div>',
                'formGroup' => '{{label}}<div class="input-icon"><span class="input-icon-addon">'
                    . $this->Icon->outline($iconName)
                    . '</span>{{input}}</div>',
            ],
        ];

        if ($formattedValue !== null && !isset($options['value'])) {
            $defaults['value'] = $formattedValue;
        }

        return $this->Form->control($fieldName, array_merge($defaults, $options));
    }

	/**
     * Mentés submit gomb - Átlátszó alap, hoverkor világoszöld háttér + zöld keret + Tooltip
     *
     * @param string|null $title Gomb felirata (alapértelmezett: 'Save')
     * @param array $options Form->button opciók (pl. 'tooltip' => '...')
     * @return string
     */
    public function saveButton(?string $title = null, array $options = []): string
    {
        $title = $title ?? __('Save');
        $tooltipText = $options['tooltip'] ?? __('Módosítások mentése és az űrlap beküldése');
        unset($options['tooltip']);

        $icon = $this->Icon->outline('device-floppy', ['class' => 'icon btn-icon-adjust']);
        $content = $icon . ' ' . $title;

        $defaultOptions = [
            'type' => 'submit',
            'escapeTitle' => false,
            'class' => 'btn btn-save-action btn-animate-icon d-inline-flex align-items-center gap-2',
            'data-bs-toggle' => 'tooltip',
            'data-bs-placement' => 'top',
            'data-bs-title' => $tooltipText,
        ];

        if (isset($options['class'])) {
            $defaultOptions['class'] .= ' ' . $options['class'];
            unset($options['class']);
        }

        $options = array_merge($defaultOptions, $options);

        return $this->Form->button($content, $options);
    }

    /**
     * Mégse / Vissza gomb - Szürke outline stílus + Tooltip
     *
     * @param string|null $title Gomb felirata (alapértelmezett: 'Cancel')
     * @param array|string|null $url Egyedi URL (alapértelmezett: ['action' => 'index'])
     * @param array $options Html->link opciók (pl. 'tooltip' => '...')
     * @return string
     */
	public function cancelButton(?string $title = null, array|string|null $url = null, array $options = []): string
	{
		$title = $title ?? __('Cancel');
		$url = $url ?? ['action' => 'index'];
		$tooltipText = $options['tooltip'] ?? __('Visszatérés a listához mentés nélkül');
		unset($options['tooltip']);

		$icon = $this->Icon->outline('x', ['class' => 'icon btn-icon-adjust']);
		$content = $icon . ' ' . $title;

		$defaultOptions = [
			'escape' => false,
			'class' => 'btn btn-cancel-action ms-4 d-inline-flex align-items-center gap-2',
			'data-bs-toggle' => 'tooltip',
			'data-bs-placement' => 'top',
			'data-bs-title' => $tooltipText,
		];

		if (isset($options['class'])) {
			$defaultOptions['class'] .= ' ' . $options['class'];
			unset($options['class']);
		}

		$options = array_merge($defaultOptions, $options);

		return $this->Html->link($content, $url, $options);
	}
	
	
	
	
	
	
}