<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('cta_section_2')) : while(have_rows('cta_section_2')) : the_row();
  $title      = get_sub_field('title');
  $text       = get_sub_field('text');
  $background = get_sub_field('background');
  $button       = get_sub_field('button');

  if($title || $text || $background || !empty($button)) :
?>
<div class="about-cta-2 ps-rel ovf-h pb-6">
  <div class="container">
    <div class="row ais gap-1 jcc">
      <?php if($title || $text): ?>
        <div class="col-md-10 py-6 wow animate__fadeIn cta"
          <?= $background ? 'style="--bg: url('.$background['url'].');"' : '' ?>          
        >
          <?php if($title): ?>
            <h2 class="title mb-0 fwn mb-0 t-wh"><?= $title ?></h2>
          <?php endif; if($text) : ?>
            <div class="description mt-4 t-wh"><?= $text ?></div>
          <?php endif;  if(!empty($button)) : ldev_btn($button, 'btn-white mt-4'); endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>