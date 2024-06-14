<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('why_section')) : while(have_rows('why_section')) : the_row();
  $title      = get_sub_field('title');
  $text       = get_sub_field('text');
  $background = get_sub_field('background');
  $items      = get_sub_field('items');

  if($title || $text || !empty($items) || $background) :
?>
<div class="dealer-why ps-rel ovf-h pt-6 pb-3"
  <?= $background ? 'style="background: url('.$background['url'].') no-repeat center / cover"' : '' ?>
>
  <div class="container">
    <div class="row ais">
      <?php if($title || $text): ?>
        <div class="col-md-5 description">
          <?php if($title): ?>
            <h2 class="title mb-4 fwl h1 t-wh"><?= $title ?></h2>
          <?php endif; if($text) : ?>
            <div class="t-wh"><?= $text ?></div>
          <?php endif; ?>
        </div>
      <?php endif; if(!empty($items)) : ?>
        <div class="col-md-12 items-cont mt-5 pt-3">
          <div class="row row-cols-sm-2 jcs row-cols-md-auto ais txt-ct">
            <?php foreach($items as $item) : 
              $icon = isset($item['icon']) ? $item['icon'] : '';
              $title = isset($item['title']) ? $item['title'] : '';
              if($icon || $title) :
            ?>
              <div class="col item">
                <?php if($icon): ?>
                  <?= ldev_logo_html($icon) ?>
                <?php endif; if($title) : ?>
                  <p class="fwl t-wh mt-3"><?= $title ?></p>
                <?php endif; ?>     
              </div>
            <?php endif; endforeach; ?>
          </div>
        </div>
      <?php endif;?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>