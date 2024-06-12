<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('description_section')) : while(have_rows('description_section')) : the_row();
  $title  = get_sub_field('title');
  $text   = get_sub_field('text');
  $image  = get_sub_field('image');
  $button = get_sub_field('button');

  if($title || $text || $image || $button) :
?>
<div class="owners-description ps-rel ovf-h">
  <div class="container-fluid">
    <div class="row ais gap-y-2">
      <?php if($title || $text): ?>
        <div class="col description py-9 px-5 wow animate__fadeIn">
          <?php if($title): ?>
            <h2 class="title mb-4 fwn"><?= $title ?></h2>
          <?php endif; if($text) : ?>
            <div><?= $text ?></div>
          <?php endif; if($button) : ldev_btn($button, 'btn-primary mt-4'); endif; ?>
        </div>
      <?php endif; if($image) : ?>
        <div class="col image"
          <?= isset($image['url']) && !empty($image) ? 'style="background: var(--ld-light) url('.$image['url'].') no-repeat 85% / cover;"' : '' ?>
        ></div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>