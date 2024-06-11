<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('cta_section')) : while(have_rows('cta_section')) : the_row();
  $title      = get_sub_field('title');
  $icon       = get_sub_field('icon');
  $background = get_sub_field('background');
  $subtitle   = get_sub_field('subtitle');

  if($title || $icon || $background || $subtitle) :
?>
<div class="front-cta py-9 ps-rel ovf-h"
  <?= $background ? 'style="--bg: url('.$background['url'].');"' : '' ?>
>
  <div class="container">
    <div class="row ais gap-y-2 wow animate__fadeIn">
      <div class="col-md-7">
        <?php if($icon): ?>
          <?= ldev_lazy_img($icon['id'], 'mb-3 icon') ?>
        <?php endif; if($title): ?>
          <h2 class="title mb-3 fwn t-wh"><?= $title ?></h2>
        <?php endif; if($subtitle) : ?>
          <div class="t-wh fs-lg"><?= $subtitle ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>