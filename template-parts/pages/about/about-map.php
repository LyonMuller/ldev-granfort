<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('map_section')) : while(have_rows('map_section')) : the_row();
  $title = get_sub_field('title');
  $text  = get_sub_field('text');
  $map   = get_sub_field('map');

  if($title || $text || $map) :
?>
<div class="about-map ps-rel ovf-h py-6 bg-light">
  <div class="container">
    <div class="row ais gap-1 jcc">
      <?php if($title || $text): ?>
        <div class="col-md-7 txt-ct mb-5 wow animate__fadeIn">
          <?php if($title): ?>
            <h2 class="title mb-0 fwn mb-0 t-up"><?= $title ?></h2>
          <?php endif; if($text) : ?>
            <div class="description mt-3"><?= $text ?></div>
          <?php endif; ?>
        </div>
      <?php endif; if(!empty($map)) : ?>
        <div class="col-md-12 map-cont wow animate__fadeIn">
          <?= ldev_lazy_img($map['id']) ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>