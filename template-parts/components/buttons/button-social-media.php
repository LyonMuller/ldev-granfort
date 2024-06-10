<?php if(!defined('ABSPATH')) die('Access denied');
  $social_media_links = ldev_social_media_links();
  if(empty($social_media_links)) return;
?>
<div class="sm-icons flex aic jce gap-1" style="--size: <?= isset($args['size']) && $args['size'] !== '' ? $args['size'].'rem' : '1rem'; ?>">
  <?php foreach($social_media_links as $social_media) : ?>
    <a target="_blank" href="<?= $social_media['url'] ?>" title="Follow us on <?= $social_media['label'] ?>"><?= $social_media['label'] ?></a>
  <?php endforeach; ?>
</div>