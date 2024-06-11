<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('technology_section')) : while(have_rows('technology_section')) : the_row();
  $title  = get_sub_field('title');
  $text   = get_sub_field('text');
  $image  = get_sub_field('image');
  $items  = get_sub_field('items');
  $button = get_sub_field('button');

  if($title || $text || !empty($items) || !empty($button)) :
?>
<div class="front-technology py-6 ps-rel ovf-h">
  <div class="container">
    <div class="row jcc ais row-cols-sm-1 row-cols-md-3 gap-y-2 wow animate__fadeIn">
      <?php if($title || $text): ?>
        <div class="col-md-7 txt-ct">
          <?php if($title): ?>
            <h2 class="title mb-4 fwn t-up"><?= $title ?></h2>
          <?php endif; if($text): ?>
            <div class="text"><?= $text ?></div>
          <?php endif; ?>
        </div>
        <div class="w-100"></div>
      <?php endif; if(!empty($items)) : foreach($items as $item) :
        $title = isset($item['title']) ? $item['title']            : '';
        $text  = isset($item['description']) ? $item['description']: '';
        $image = isset($item['image']) ? $item['image']            : '';
        $link  = isset($item['link']) ? $item['link']              : '';
        if(!$title || !$text || !$image || !$link) continue;
      ?>
        <div class="col flex wow animate__fadeInUp">
          <div class="item h-100 bg-light">
            <?php if($image) : ?>
              <?= ldev_lazy_img($image['id'], 'w-100') ?>
            <?php endif; ?>
            <div class="desc px-2 py-2">
              <?php if($title): ?>
                <h3 class="title h5 fwn mb-3"><?= $title ?></h3>
              <?php endif; if($text): ?>
                <div class="txt"><?= $text ?></div>
              <?php endif; if($link) : ?>
                <?= ldev_btn($link, 'btn-link primary mt-3') ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>