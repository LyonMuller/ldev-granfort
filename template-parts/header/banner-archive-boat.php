<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php 
  $title    = is_post_type_archive('boat') ? get_theme_mod('ldev_boats_title') : str_replace('Category: ', 'Category: ', get_the_archive_title());
  $background = get_theme_mod('ldev_boats_background');  
  
  if($title || $background) :
?>
<div class="secao-banner__archive bg-primary ps-rel ovf-h"
    <?php if($background): ?>
      style="--bg: url('<?= $background ?>');"
    <?php endif; ?>
>
  <div class="container ps-rel z1">
    <div class="row aic jcc txt-ct">
      <div class="col-lg-8">
        <?php if($title): ?>
          <h1 class="mb-0 fs-display t-wh fwl"><?= $title ?></h1>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<?php endif;?>
