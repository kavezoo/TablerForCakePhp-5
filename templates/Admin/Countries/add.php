<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Country $country
 * @var \Cake\Collection\CollectionInterface|string[] $continents
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Countries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="countries form content">
            <?= $this->Form->create($country) ?>
            <fieldset>
                <legend><?= __('Add Country') ?></legend>
                <?php
                    echo $this->Form->control('continent_id', ['options' => $continents]);
                    echo $this->Form->control('iso2');
                    echo $this->Form->control('name');
                    echo $this->Form->control('endonim_name');
                    echo $this->Form->control('locale');
                    echo $this->Form->control('timezone');
                    echo $this->Form->control('phone_prefix');
                    echo $this->Form->control('logo');
                    echo $this->Form->control('currency');
                    echo $this->Form->control('visible');
                    echo $this->Form->control('pos');
                    echo $this->Form->control('club_count');
                    echo $this->Form->control('setup_count');
                    echo $this->Form->control('user_count');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
