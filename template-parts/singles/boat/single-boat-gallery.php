<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('gallery_section')) : while(have_rows('gallery_section')) : the_row();
  $title   = get_sub_field('title');
  $gallery = get_sub_field('gallery');
  if($title && !empty($gallery)) :
?>
<section class="gallery-section ps-rel ovf-h pt-3" id="gallery" data-section="Gallery">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 mb-4 txt-ct">
        <h2 class="title mb-0 t-up fwn"><?= $title ?></h2>
      </div>
    </div>
    <div class="row ais grid">
      <?php foreach($gallery as $image) : ?>
        <div class="col px-0 image ps-rel">
          <?= ldev_lazy_img($image['id'], 'ps-abs object-cover inset-0 h-100 w-100') ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>