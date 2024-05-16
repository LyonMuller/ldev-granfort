<?php if(!defined('ABSPATH')) die('Access denied');
  $logo = ldev_logo_html();
  $btn_text = get_theme_mod('ldev_section_footer_button_text');
  $btn_link_type  = get_theme_mod('ldev_section_footer_button_link');

  if(!$btn_text && !$btn_link_type) return;
?>
<div class="col info-button txt-ct">
  <?= ldev_btn_customizer($btn_link_type, ['text' => $btn_text, 'modal' => 'orcamento'], 'btn-outline-white') ?>
</div>