<?php
/**
 * Tabler Pagination Element (Ellipzissel / pontokkal)
 * @var \App\View\AppView $this
 */

$this->Paginator->setTemplates([
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    // px-1 a szűk távolságért, inline-block + translateY a függőleges pozícióért
	'ellipsis' => '<li class="page-item disabled" style="margin: 0 2px;"><span class="page-link border-0 bg-transparent px-0" style="display:inline-block; transform: translateY(2px); width: 12px; margin-left: -12px; margin-right: -12px; letter-spacing: 1px; font-weight: bold;">...</span></li>',
    'first' => '<li class="page-item"><a class="page-link" href="{{url}}">' . $this->SystemIcon->sysIcon('first') . '</a></li>',
    'last' => '<li class="page-item"><a class="page-link" href="{{url}}">' . $this->SystemIcon->sysIcon('last') . '</a></li>',
    'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">' . $this->SystemIcon->sysIcon('prev') . '</a></li>',
    'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">' . $this->SystemIcon->sysIcon('prev') . '</a></li>',
    'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">' . $this->SystemIcon->sysIcon('next') . '</a></li>',
    'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">' . $this->SystemIcon->sysIcon('next') . '</a></li>',
]);
?>

<div class="card-body border-top py-3">
    <div class="d-flex align-items-center">
        <p class="m-0 text-secondary">
            <?= $this->Paginator->counter(__('Megjelenítve: {{start}} - {{end}} / {{count}} találat')) ?>
        </p>
        <ul class="pagination m-0 ms-auto">
            <?= $this->Paginator->first() ?>
            <?= $this->Paginator->prev() ?>
            
            <!-- A modulus határozza meg a környező oldalak számát -->
            <?= $this->Paginator->numbers([
                'modulus' => 4,          // Hány oldalszám látszódjon az aktuális körül
                'first' => 1,            // Az 1. oldalszámot mindig mutassa az ellipzis előtt
                'last' => 1,              // Az utolsó oldalszámot mindig mutassa az ellipzis után
				//'templates' => [
				//	'ellipse' => '<li class="page-item disabled"><span class="page-link border-0 bg-transparent px-2" style="line-height: 1.8;">.xx..</span></li>'
				//]
            ]) ?>
            
            <?= $this->Paginator->next() ?>
            <?= $this->Paginator->last() ?>
        </ul>
    </div>
</div>