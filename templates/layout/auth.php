<!doctype html>
<html lang="<?= h(Cake\I18n\I18n::getLocale()) ?>">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title><?= $this->fetch('title') ?> - <?= __('Tabler') ?></title>
    
    <!-- Tabler CSS -->
    <?= $this->Html->css(['tabler.min', 'tabler-flags.min', 'tabler-payments.min', 'tabler-vendors.min', 'custom']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body class="d-flex flex-column">
    <?= $this->fetch('content') ?>
    
    <!-- Tabler JS & Page Scripts -->
    <?= $this->Html->script(['tabler.min']) ?>
    <?= $this->fetch('script') ?>
</body>
</html>