<?php
	$this->Paginator->setTemplates([
		'sort' => '<a href="{{url}}" class="d-inline-flex align-items-center text-reset text-decoration-none">{{text}} <span class="sort-arrows d-inline-flex ms-1">' . $this->SystemIcon->sysIcon('sort-asc-desc') . '</span></a>',
		'sortAsc' => '<a href="{{url}}" class="d-inline-flex align-items-center text-reset text-decoration-none active asc">{{text}} <span class="sort-arrows d-inline-flex ms-1">' . $this->SystemIcon->sysIcon('sort-asc-desc') . '</span></a>',
		'sortDesc' => '<a href="{{url}}" class="d-inline-flex align-items-center text-reset text-decoration-none active desc">{{text}} <span class="sort-arrows d-inline-flex ms-1">' . $this->SystemIcon->sysIcon('sort-asc-desc') . '</span></a>',
	]);
?>