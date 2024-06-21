<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php 
  $title    = is_post_type_archive('boat') ? get_theme_mod('ldev_boats_title') : str_replace('Category: ', 'Category: ', get_the_archive_title());
  $background = get_theme_mod('ldev_boats_background');  
  $background_video = get_theme_mod('ldev_boats_video_background');
  $video_url = isset($background_video) && !empty($background_video) ? wp_get_attachment_url($background_video) : '';
  
  if($title || $background || $background_video) :
?>
<section class="secao-banner__archive bg-primary ps-rel ovf-h"
    <?php if($background): ?>
      style="--bg: url('<?= $background ?>');"
    <?php endif; ?>
>
  <?php if($video_url):?>
    <video
      autoplay
      muted
      loop
      disablepictureinpicture
      disableremoteplayback
      data-poster="<?= $background ?>"
      data-src="<?= $video_url ?>"
      class="z1 ps-abs inset-0 h-100 w-100 object-cover lozad"
      preload="none"
    >
      <source src="<?= $video_url ?>" type="video/mp4">
    </video>
  <?php endif; ?>
  <div class="container ps-rel z2">
    <div class="row aic jcc txt-ct">
      <div class="col-lg-8">
        <?php if($title): ?>
          <h1 class="mb-0 fs-display t-wh fwl"><?= $title ?></h1>
        <?php endif;?>
      </div>
    </div>
  </div>

</section>
<?php endif;?>