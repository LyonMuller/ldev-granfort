<?php if(!defined('ABSPATH')) die('Access denied');
  $logo = ldev_logo_html();
  if(!$logo) return;
?>
<div class="col info-logo">
  <?php if($logo): ?>
    <a href="<?= site_url('/') ?>" title="<?= bloginfo( 'name' ) ?>" class="logo-footer flex">
      <?= $logo ?>
    </a>
  <?php endif; ?>
</div>