<?php if(!defined('ABSPATH')) die('Access denied');
  $social_media_links = ldev_social_media_links();
  $exibir = get_theme_mod('ldev_section_footer_show_social_media');
  if(!$exibir) return;
  if(empty($social_media_links)) return;
?>
<div class="col-5 col-md-1 offset-lg-2 sm-cont">
  <div class="sm-icons flex aic jce gap-1">
    <?php foreach($social_media_links as $social_media) : ?>
      <a target="_blank" href="<?= $social_media['url'] ?>" title="Siga-nos no <?= $social_media['label'] ?>"><?= $social_media['label'] ?></a>
    <?php endforeach; ?>
  </div>
</div>