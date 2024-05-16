<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php 
  $titulo    = is_post_type_archive('produto') ? get_theme_mod('ldev_products_title') : str_replace('Categoria: ', 'Categoria: <b>', get_the_archive_title()) . '</b>';
  $background = get_theme_mod('ldev_products_background');  
  
  if($titulo || $background) :
?>
<div class="secao-banner__produtos bg-light ps-rel ovf-h py-9"
    <?php if($background): ?>
      style="--bg: url('<?= $background ?>');"
    <?php endif; ?>
>
  <div class="container ps-rel z1">
    <div class="row aic">
      <div class="col-lg-8">
        <?php if($titulo): ?>
          <h1 class="mb-0 h2 fwl titulo-span-secondary"><?= $titulo ?></h1>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<?php endif;?>
