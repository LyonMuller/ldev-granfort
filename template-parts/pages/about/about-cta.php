<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('cta_section')) : while(have_rows('cta_section')) : the_row();
  $title      = get_sub_field('title');
  $text       = get_sub_field('text');
  $background = get_sub_field('background');
  $form       = get_sub_field('form');

  if($title || $text || $background || !empty($form)) :
?>
<div class="about-cta ps-rel ovf-h py-6">
  <div class="container">
    <div class="row ais gap-1 jcc">
      <?php if($title || $text): ?>
        <div class="col-md-12 py-9 mb-5 wow animate__fadeIn cta"
          <?= $background ? 'style="--bg: url('.$background['url'].');"' : '' ?>          
        >
          <?php if($title): ?>
            <h2 class="title mb-0 fwn mb-0 t-wh"><?= $title ?></h2>
          <?php endif; if($text) : ?>
            <div class="description mt-3 t-wh"><?= $text ?></div>
          <?php endif; ?>
        </div>
      <?php endif; if(!empty($form)) : ?>
        <div class="col-lg-10">
          <?= ldev_form_wp($form) ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>