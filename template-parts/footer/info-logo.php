<?php if(!defined('ABSPATH')) die('Access denied');
  $logo = ldev_logo_html();
  $footer_title = get_theme_mod('ldev_footer_title');
  $footer_text  = get_theme_mod('ldev_footer_text');
  if(!$footer_title && !$footer_text && !$logo) return;
?>
<div class="col-md-3 info-logo">
  <?php if($logo): ?>
    <a href="<?= site_url('/') ?>" title="<?= bloginfo( 'name' ) ?>" class="logo-footer mb-3 flex">
      <?= $logo ?>
    </a>
  <?php endif; ?>
  <?php if($footer_title): ?>
    <h2 class="footer-info-title fs-sm h5 t-secondary t-up my-3"><?= $footer_title ?></h2>
  <?php endif; if($footer_text): ?>
    <p class="footer-info-text t-wh fwl fs-sm"><?= $footer_text ?></p>
  <?php endif; ?>
</div>