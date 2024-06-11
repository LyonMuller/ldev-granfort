<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('about_section')) : while(have_rows('about_section')) : the_row();
  $title  = get_sub_field('title');
  $image  = get_sub_field('image');
  $items  = get_sub_field('items');
  $button = get_sub_field('button');

  if($title || $image || !empty($items) || !empty($button)) :
?>
<div class="front-why-granfort py-6 ps-rel ovf-h  bg-light">
  <div class="container">
    <div class="row jcc row-cols-sm-1 row-cols-md-3 gap-y-2 wow animate__fadeIn">
      <?php if($title || $image): ?>
        <div class="col-md-12 txt-ct">
          <?php if($title): ?>
            <h2 class="title mb-4 fwn t-up"><?= $title ?></h2>
          <?php endif; if($image): ?>
            <?= ldev_lazy_img($image['id'], 'mb-4 w-100') ?>
          <?php endif; ?>
        </div>
      <?php endif; if(!empty($items)) : foreach($items as $item) :
        $title = isset($item['title']) ? $item['title'] : '';
        $text  = isset($item['description']) ? $item['description'] : '';
        if(!$title || !$text) continue;
      ?>
        <div class="col">
          <?php if($title): ?>
            <h3 class="title h5 fwn mb-3"><?= $title ?></h3>
          <?php endif; if($text): ?>
            <div class="txt"><?= $text ?></div>
          <?php endif; ?>
        </div>
      <?php endforeach; endif; if($button): ?>
        <div class="col-md-4 txt-ct mt-4">
          <?= ldev_btn($button, 'btn-outline primary') ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>