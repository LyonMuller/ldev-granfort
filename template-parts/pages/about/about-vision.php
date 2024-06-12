<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('vision_section')) : while(have_rows('vision_section')) : the_row();
  $title = get_sub_field('title');
  $items  = get_sub_field('items');

  if($title || !empty($items)) :
?>
<div class="about-vision ps-rel ovf-h pt-6 pb-9">
  <div class="container">
    <div class="row ais gap-y-2 jcc">
      <?php if($title): ?>
        <div class="col description mb-5 wow animate__fadeIn">
          <h2 class="title mb-0 fwn txt-ct mb-0 t-up"><?= $title ?></h2>
        </div>
      <?php endif; if(!empty($items)) : foreach ($items as $item) :
        $icon        = isset($item['icon']) ? $item['icon']              : '';
        $image       = isset($item['image']) ? $item['image']            : '';
        $title       = isset($item['title']) ? $item['title']            : '';
        $description = isset($item['description']) ? $item['description']: '';
        $last = end($items) === $item;
        $class = $last ? 'col-md-12 gap-1 last' : 'col-md-6';
        if(!$icon || !$image || !$title || !$description) continue;
      ?>
        <div class="flex item <?= $class ?>">
          <?php if($image || $icon): ?>
            <div class="col-md-6 img-cont">
              <div class="image flex jcc aic"
                <?= isset($image['url']) && !empty($image) ? 'style="--bg: url('.$image['url'].');"' : '' ?>
              >
                <?php if($icon): ?>
                  <div class="icon"><?= ldev_logo_html($icon) ?></div>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; if($title || $description) :?>
            <div class="col-md-6 px-2 py-2 bg-light description flex aic">
              <div>
                <?php if($title): ?>
                  <h3 class="title mb-3 fwn"><?= $title ?></h3>
                <?php endif; if($description) : ?>
                  <div class="description"><?= $description ?></div>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>          
      <?php endforeach; endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>