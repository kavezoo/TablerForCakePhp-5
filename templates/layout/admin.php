<?php
/**
 * Tabler Admin Layout - Top Navigation Only
 * @var \App\View\AppView $this
 */
?>
<!doctype html>
<html lang="hu">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Tabler • <?= $this->fetch('title') ?></title>

    <!-- Tabler CSS -->
    <?= $this->Html->css(['tabler.min', 'main']) ?>
	
	<!-- Vendor CSS -->
    <?= $this->fetch('css') ?>
	
</head>
<body>

    <div class="page">
        <!-- TopHeader (Header + Menü) -->
        <?= $this->element('admin/topheader') ?>

        <!-- Header (Header + Menü) -->
        <?= $this->element('admin/header') ?>

        <!-- Fő tartalom -->
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl pt-3">
                    <?= $this->Flash->render() ?>
					
					<!-- Content -->
                    <?= $this->fetch('content') ?>
					
                </div>
            </div>

            <!-- Footer -->
            <?= $this->element('admin/footer') ?>
			
        </div>
    </div>

    <!-- Tabler JS -->
    <?= $this->Html->script(['tabler.min']) ?>
	
	<!-- Vendor JS -->
    <?= $this->fetch('script') ?>
	
	<!-- My JS -->
    <?= $this->fetch('footer') ?>
	
</body>
</html>