<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('social_media_section')) : while(have_rows('social_media_section')) : the_row();
  $title     = get_sub_field('title');
  $shortcode = get_sub_field('shortcode');

  if($title || $shortcode) :
?>
<div class="front-social-media py-6 ps-rel ovf-h">
  <div class="container">
    <div class="row jcc ais gap-y-2 wow animate__fadeIn">
      <?php if($title): ?>
        <div class="col-md-7 txt-ct">
          <h2 class="title mb-4 fwn t-up"><?= $title ?></h2>
        </div>
        <div class="w-100"></div>
      <?php endif; if($shortcode) : ?>
        <div class="col flex wow animate__fadeInUp">
          <?= do_shortcode($shortcode) ?>
        </div>  
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>