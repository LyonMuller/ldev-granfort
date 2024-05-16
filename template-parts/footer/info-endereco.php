<?php if(!defined('ABSPATH')) die('Access denied');
  $endereco = get_theme_mod('ldev_company_address');
  $link_google_maps = get_theme_mod('ldev_company_google_maps');
  if(!$endereco) return;
?>
<div class="col info-logo my-3">
  <h2 class="h4 fwl mb-4 t-wh">Endereço</h2>
  <p class="t-wh"><?= $endereco ?></p>
  <?php if($link_google_maps): ?>
    <a href="<?= $link_google_maps ?>" class="btn-outline-white" target="_blank">Ver no Google Maps</a>
  <?php endif; ?>
</div>