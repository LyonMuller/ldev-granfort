<?php
  $background    = get_theme_mod('ldev_boats_cta_section_background');
  $title         = get_theme_mod('ldev_boats_cta_section_title');
  $text          = get_theme_mod('ldev_boats_cta_section_text');
  $button_text   = get_theme_mod('ldev_boats_cta_section_button_text');
  $button_link   = get_theme_mod('ldev_boats_cta_section_button_link');
  $button_2_text = get_theme_mod('ldev_boats_cta_section_button_2_text');
  $button_2_link = get_theme_mod('ldev_boats_cta_section_button_2_link') ? get_permalink(get_theme_mod('ldev_boats_cta_section_button_2_link')) : '';

  if($background || $title || $text || ($button_text && $button_link) || ($button_2_text && $button_2_link)) :
?>
<div class="cta-section" style="background: linear-gradient(to left, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.6) 100%), url(<?= esc_url($background); ?>) no-repeat center / cover;">
  <div class="container py-6">
    <div class="row">
      <div class="col-md-5">
        <?php if($title): ?>
          <h2 class="cta-title t-wh fwn"><?= esc_html($title); ?></h2>
        <?php endif; if($text) : ?>
          <p class="cta-text t-wh"><?= esc_html($text); ?></p>
        <?php endif; if(($button_text && $button_link) || ($button_2_text && $button_2_link)) : ?>
          <div class="cta-buttons flex gap-1">
            <?php if ($button_text && $button_link) : ?>
              <a href="<?= esc_url($button_link); ?>" class="btn-white"><?= esc_html($button_text); ?></a>
            <?php endif; if ($button_2_text && $button_2_link) : ?>
              <a href="<?= esc_url($button_2_link); ?>" class="btn-outline white"><?= esc_html($button_2_text); ?></a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>