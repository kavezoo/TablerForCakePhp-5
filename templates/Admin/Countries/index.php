<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Country> $countries
 */
?>
<div class="countries index content">
    <?= $this->Html->link(__('New Country'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Countries') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('continent_id') ?></th>
                    <th><?= $this->Paginator->sort('iso2') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('endonim_name') ?></th>
                    <th><?= $this->Paginator->sort('locale') ?></th>
                    <th><?= $this->Paginator->sort('timezone') ?></th>
                    <th><?= $this->Paginator->sort('phone_prefix') ?></th>
                    <th><?= $this->Paginator->sort('logo') ?></th>
                    <th><?= $this->Paginator->sort('currency') ?></th>
                    <th><?= $this->Paginator->sort('visible') ?></th>
                    <th><?= $this->Paginator->sort('pos') ?></th>
                    <th><?= $this->Paginator->sort('club_count') ?></th>
                    <th><?= $this->Paginator->sort('setup_count') ?></th>
                    <th><?= $this->Paginator->sort('user_count') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($countries as $country): ?>
                <tr>
                    <td><?= $this->Number->format($country->id) ?></td>
                    <td><?= $country->hasValue('continent') ? $this->Html->link($country->continent->name, ['controller' => 'Continents', 'action' => 'view', $country->continent->id]) : '' ?></td>
                    <td><?= h($country->iso2) ?></td>
                    <td><?= h($country->name) ?></td>
                    <td><?= h($country->endonim_name) ?></td>
                    <td><?= h($country->locale) ?></td>
                    <td><?= h($country->timezone) ?></td>
                    <td><?= h($country->phone_prefix) ?></td>
                    <td><?= h($country->logo) ?></td>
                    <td><?= h($country->currency) ?></td>
                    <td><?= h($country->visible) ?></td>
                    <td><?= $this->Number->format($country->pos) ?></td>
                    <td><?= $this->Number->format($country->club_count) ?></td>
                    <td><?= $this->Number->format($country->setup_count) ?></td>
                    <td><?= $this->Number->format($country->user_count) ?></td>
                    <td><?= h($country->created) ?></td>
                    <td><?= h($country->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $country->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $country->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $country->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $country->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>