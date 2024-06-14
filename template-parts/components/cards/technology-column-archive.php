<?php 
  $image    = isset($args['image']) ? $args['image']      : '';
  $subtitle = isset($args['subtitle']) ? $args['subtitle']: '';
  $title    = isset($args['title']) ? $args['title']      : '';
  $text     = isset($args['text']) ? $args['text']        : '';
  $style = isset($args['style']) ? $args['style'] : 'bg-white'
?>
<?php if ($image || $subtitle || $title || $text) : ?>
  <div class="col flex">
    <div class="technology-item">
      <?php if ($image) : ?>
        <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($title); ?>" />
      <?php endif; ?>
      <div class="desc px-2 py-2 <?= $style ?>">
        <?php if ($subtitle) : ?>
          <p class="technology-subtitle fs-sm t-up t-secondary"><?= esc_html($subtitle); ?></p>
        <?php endif; if ($title) : ?>
          <h2 class="technology-title mb-3 fwn h4"><?= esc_html($title); ?></h2>
        <?php endif;if ($text) : ?>
          <div class="technology-text"><?= esc_html($text); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php endif; ?>