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
            <h2 class="page-title"><?= __('Új város hozzáadása') ?></h2>
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
    <div class="card-body">
        <div class="row row-cards">
            <div class="col-md-6">
                <?= $this->Form->control('name', ['label' => __('Város neve'), 'class' => 'form-control', 'required' => true]) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('zip', ['label' => __('Irányítószám'), 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('shortname', ['label' => __('Rövid név'), 'class' => 'form-control', 'required' => true]) ?>
            </div>

            <div class="col-md-6">
                <?= $this->Form->control('country_id', ['options' => $countries, 'label' => __('Ország'), 'class' => 'form-select tom-select', 'empty' => __('Válasszon országot...')]) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->control('county_id', ['options' => $counties, 'label' => __('Megye'), 'class' => 'form-select tom-select', 'empty' => __('Válasszon megyét...')]) ?>
            </div>

            <div class="col-12"><hr class="my-2"><h4 class="card-title"><?= __('Koordináták') ?></h4></div>

            <div class="col-md-3">
                <?= $this->Form->control('lat', ['label' => __('Lat (GMap)'), 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('lng', ['label' => __('Lng (GMap)'), 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('lat2', ['label' => __('Lat (TXT)'), 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('lng2', ['label' => __('Lng (TXT)'), 'class' => 'form-control']) ?>
            </div>
        </div>
    </div>
    <div class="card-footer text-start">
		<?= $this->Form->button(
			$this->Icon->render('plus') . ' ' . __('Save'),
			[
				'type' => 'submit',
				'escapeTitle' => false,
				'class' => 'btn btn-outline-success btn-animate-icon btn-animate-icon-rotate d-none d-sm-inline-block'
			]
		) ?>
    </div>
    <?= $this->Form->end() ?>
</div>