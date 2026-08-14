<?php
// Beolvassuk a sprite-ból az összes elérhető ikon azonosítóját
$svgPath = WWW_ROOT . 'icons/icons.svg';
$iconNames = [];

if (file_exists($svgPath)) {
    $xml = simplexml_load_file($svgPath);
    foreach ($xml->symbol as $symbol) {
        // Kiszedjük az 'icon-' előtagot, hogy csak a Helpernek átadandó nevet kapjuk meg
        $iconNames[] = str_replace('icon-', '', (string)$symbol['id']);
    }
}
?>

<style>
  .icon-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
    gap: 15px;
    padding: 20px;
    font-family: sans-serif;
  }

  .icon-card {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 80px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background-color: #fff;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
  }

  /* Nagyobb ikonméret */
  .icon-card svg {
    width: 48px;
    height: 48px;
    stroke: #333;
  }

  /* Hover effektus */
  .icon-card:hover {
    border-color: #007bff;
    background-color: #f0f7ff;
    transform: translateY(-3px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .icon-card:hover svg {
    stroke: #007bff;
  }
</style>

<h2>Elérhető ikonok (<?= count($iconNames) ?> db)</h2>
<p>Vidd az egeret az ikon fölé a név megjelenítéséhez, vagy kattints rá a név másolásához!</p>

<div class="icon-grid">
  <?php foreach ($iconNames as $name): ?>
    <div 
      class="icon-card" 
      title="<?= h($name) ?>" 
      data-bs-toggle="tooltip" 
      onclick="navigator.clipboard.writeText('<?= h($name) ?>'); alert('Másolva: <?= h($name) ?>');"
    >
      <?= $this->Icon->render($name) ?>
    </div>
  <?php endforeach; ?>
</div>
