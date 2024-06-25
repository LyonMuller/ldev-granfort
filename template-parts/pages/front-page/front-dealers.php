<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('find_a_dealer_section', get_option('page_on_front'))) : while(have_rows('find_a_dealer_section', get_option('page_on_front'))) : the_row();
  $title    = get_sub_field('title');
  $show_map = get_sub_field('show_map');
  $dealers  = get_sub_field('dealers');
  $iframe   = get_sub_field('iframe');

  if($title || $text || !empty($dealers) || $iframe) :
?>
<div class="front-dealers ps-rel ovf-h">
  <div class="container-fluid">
    <div class="row jcc ais row-cols-1 row-cols-md-2 gap-y-2 wow animate__fadeIn">
      <?php if($title || !empty($items)): ?>
        <div class="col-md-3 pt-2 ovf-h px-1">
          <?php if($title): ?>
            <h2 class="title mb-4 fwn h4"><?= $title ?></h2>
          <?php endif; if(!empty($dealers)) : ?>
            <div class="dealers grid gap-1 pb-2">
              <?php foreach($dealers as $item) :
                $title = isset($item['dealer_name']) ? $item['dealer_name'] : '';
                $text  = isset($item['address']) ? $item['address']: '';
                $link  = isset($item['link']) ? $item['link'] : '';
                if(!$title || !$text  || !$link) continue;
              ?>
                <div class="item h-100 bg-light py-2 px-2">
                  <div class="desc">
                    <?php if($title): ?>
                      <h3 class="title h5 fwn mb-3"><?= $title ?></h3>
                    <?php endif; if($text): ?>
                      <div class="txt t-gray"><?= $text ?></div>
                    <?php endif; if($link) :
                      $link = [
                        'title' => 'Get in Touch',
                        'url' => $link
                      ];
                    ?>
                      <?= ldev_btn($link, 'btn-link primary mt-3') ?>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif;?>
        </div>
      <?php endif; if($iframe) : ?>
        <div class="<?= $title || !empty($items) ? 'col-md-9 pr-0' : 'col-md-12 px-0' ?> map ">
          <?= $iframe ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>