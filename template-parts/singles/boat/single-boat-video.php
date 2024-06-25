<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('video_section')) : while(have_rows('video_section')) : the_row();
  $video       = get_sub_field('video');
  $placeholder = get_sub_field('placeholder');
  if($video) :
?>
<section class="video-section ps-rel ovf-h">
  <?= ldev_youtube($video, $placeholder) ?>
</section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>