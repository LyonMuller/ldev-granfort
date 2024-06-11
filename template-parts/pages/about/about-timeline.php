<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('timeline_section')) : while(have_rows('timeline_section')) : the_row();
  $title = get_sub_field('title');
  $timeline  = get_sub_field('timeline');

  if($title || !empty($timeline)) :
?>
<div class="about-timeline ps-rel ovf-h py-6">
  <div class="container">
    <div class="row ais gap-y-2 jcc">
      <?php if($title): ?>
        <div class="col description mb-5 wow animate__fadeIn">
          <h2 class="title mb-0 fwn txt-ct mb-0 t-up"><?= $title ?></h2>
        </div>
      <?php endif; if(!empty($timeline)) : ?>
        <!-- splide -->
        <div class="splide timeline">
          <div class="splide__track">
            <ul class="splide__list">
              <?php foreach($timeline as $item) : ?>
                <li class="splide__slide">
                  <div class="timeline-item">
                    <div class="timeline-item__date"><?= $item['year'] ?></div>
                    <div class="timeline-item__content">
                      <h3 class="timeline-item__title"><?= $item['title'] ?></h3>
                      <div class="timeline-item__text"><?= $item['text'] ?></div>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>