<?php
  $message       = get_theme_mod('ldev_products_cta_message');
  $background    = get_theme_mod('ldev_products_cta_background');
  $title         = get_theme_mod('ldev_products_cta_title');
  $button_text   = get_theme_mod('ldev_products_cta_button_text');
  $button_link   = get_theme_mod('ldev_products_cta_button_link');
  $button_2_text = get_theme_mod('ldev_products_cta_button_2_text');
  $button_2_link = get_theme_mod('ldev_products_cta_button_2_link');

  if ($message || $background || $title || $button_text || $button_link || $button_2_text || $button_2_link) :
?>
  <div class="col boat-cta-cont">
    <div class="boat-cta h-100 px-2 py-2"
      style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 100%), url(<?= esc_url($background); ?>) no-repeat center / cover;"
    >
      <div class="boat-cta__content">
        <?php if($title): ?>
          <h2 class="boat-cta__title h4 t-wh fwn"><?= esc_html($title); ?></h2>
        <?php endif; ?>
        <div class="gap-y-1 flex flex-wrap">
          <a href="<?= esc_url($button_link); ?>" class="btn-white"><?= esc_html($button_text); ?></a>
          <a href="<?= esc_url($button_2_link); ?>" class="btn-outline white"><?= esc_html($button_2_text); ?></a>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>