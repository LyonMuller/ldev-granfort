<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('hero_section')) : while(have_rows('hero_section')) : the_row();
  $title      = get_sub_field('title');
  $text       = get_sub_field('text');
  $background = get_sub_field('background');
  $button     = get_sub_field('button');

  if($title || $text || $background || !empty($button)) :
?>
<section class="hero-section ps-rel ovf-h pt-6"
  <?= $background ? 'style="height: 100vh; background: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0,0,0,.35)), url('.$background['url'].') no-repeat center / cover;"' : '' ?>
>
  <div class="container">
    <div class="row ais gap-1">
      <?php if($title || $text): ?>
        <div class="col-md-5 wow animate__fadeIn cta">
          <?php if($title): ?>
            <h2 class="title mb-0 fwn mb-0 t-wh"><?= $title ?></h2>
          <?php endif; if($text) : ?>
            <div class="description mt-4 t-wh"><?= $text ?></div>
          <?php endif;  if(!empty($button)) : ldev_btn($button, 'btn-outline white mt-4'); endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>