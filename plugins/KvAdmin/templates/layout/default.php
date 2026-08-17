<?php
/**
 * Tabler Admin Layout - Top Navigation Only
 * @var \App\View\AppView $this
 */
?>
<!doctype html>
<html lang="hu"> <?php // data-bs-theme="dark"> ?>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Tabler • <?= $this->fetch('title') ?></title>

    <!-- Tabler CSS --><?= $this->Html->css(['KvAdmin.tabler.min', 'KvAdmin.main']) ?>
	
	<!-- Vendor CSS --><?= $this->fetch('css') ?>
	
</head>
<body>

    <div class="page">
        <!-- TopHeader (Header + Menü) -->
        <?= $this->element('KvAdmin.topheader') ?>

        <!-- Header (Header + Menü) -->
        <?= $this->element('KvAdmin.header') ?>

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
            <?= $this->element('KvAdmin.footer') ?>
			
        </div>
    </div>


    <!-- Tabler JS --><?= $this->Html->script(['KvAdmin.tabler.min']) ?>
	
	<!-- KvAdmin/Vendor JS -->
	<?= $this->fetch('script') ?>
	
	<!-- KvAdmin JS -->
	<?= $this->fetch('footer') ?>
	
</body>
</html>