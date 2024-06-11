<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('mansonry_section')) : while(have_rows('mansonry_section')) : the_row();
  $title   = get_sub_field('title');
  $text    = get_sub_field('text');
  $gallery = get_sub_field('gallery');

  if($title || $text || !empty($gallery)) :
?>
<div class="about-mansonry ps-rel ovf-h">
  <div class="container-fluid">
    <div class="row ais">
      <?php if($title || $text): ?>
        <div class="col py-3 px-3 bg-brand description wow animate__fadeIn">
          <?php if($title): ?>
            <h2 class="title mb-4 fwn h3 t-wh"><?= $title ?></h2>
          <?php endif; if($text) : ?>
            <div class="t-wh"><?= $text ?></div>
          <?php endif; ?>
        </div>
      <?php endif; if(!empty($gallery)) : foreach($gallery as $c => $image) : ?>
        <div class="col image bg-primary ps-rel" data-image="<?= $c ?>">
          <?= ldev_lazy_img($image['id'], 'ps-abs inset-0 w-100 h-100 object-cover') ?>
        </div>
      <?php endforeach; endif;?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>