<?php 
  $boat = isset($args['boat']) && !empty($args['boat']) ? $args['boat'] : null;
  $thumbnail_id = get_post_thumbnail_id($boat['id']);

?>
<div class="boat-item-cont <?= esc_attr(implode(' ', $boat['terms'])); ?>">
  <a href="<?= get_the_permalink($boat['id']) ?>" class="boat-item">
    <div class="category border-bottom gray-250 pb-1 mb-4">
      <p class="fs-sm t-gray t-up flex"><?= $boat['term_name'] ?> <span class="detail t-secondary">/</span> <span class="detail t-gray">/</span></p>
    </div>
    <h3 class="fwn t-primary h5 my-4"><?= esc_html($boat['title']); ?></h3>
    <?= ldev_lazy_img($thumbnail_id, 'boat-thumb mb-3', 'thumbnail') ?>
    <button class="btn-unstyled btn-link">Discover</button>
    <?php if(isset($boat['excerpt']) && $boat['excerpt'] !== ''): ?>
      <p class="t-gray mt-3 fs-sm"><?= esc_html($boat['excerpt']); ?></p>
    <?php endif; ?>
  </a>
</div>