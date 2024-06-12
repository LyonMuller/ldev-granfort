<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('timeline_section')) : while(have_rows('timeline_section')) : the_row();
  $title    = get_sub_field('title');
  $timeline = get_sub_field('timeline');

  $years = [];
  if(!empty($timeline)) {
    foreach($timeline as $item) {
      $year = isset($item['year']) ? $item['year'] : '';
      if(empty($year)) continue;
      $years[] = $year;
    }
  }

  if($title || !empty($timeline)) :
?>
<div class="about-timeline ps-rel ovf-h pt-6 pb-9">
  <div class="container">
    <div class="row ais gap-y-2 jcc">
      <?php if($title): ?>
        <div class="col description mb-5 wow animate__fadeIn">
          <h2 class="title mb-0 fwn txt-ct mb-0 t-up"><?= $title ?></h2>
        </div>
      <?php endif; if(!empty($timeline)) : ?>
        <!-- splide -->
        <div class="col-lg-12 splide timeline">
          <div class="splide__arrows ps-abs z1">
            <button class="splide__arrow splide__arrow--prev btn-unstyled">
              <svg width="42" height="42" fill="none" viewBox="0 0 42 42"><g stroke="currentColor" stroke-linejoin="round" stroke-width="1.25"><path stroke-linecap="round" d="M21 41C9.9543 41 1 32.0457 1 21S9.9543 1 21 1s20 8.9543 20 20-8.9543 20-20 20Z"/><path d="m21 29-8-8 8-8M29 21H13"/></g></svg>
            </button>
            <button class="splide__arrow splide__arrow--next btn-unstyled">
              <svg width="42" height="42" fill="none" viewBox="0 0 42 42"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.25" d="M21 41c11.0457 0 20-8.9543 20-20S32.0457 1 21 1 1 9.9543 1 21s8.9543 20 20 20Z"/><path stroke="currentColor" stroke-linejoin="round" stroke-width="1.25" d="m21 29 8-8-8-8M13 21h16"/></svg>
            </button>
          </div>
          <div class="splide__track">
            <ul class="splide__list">
              <?php foreach($timeline as $item) :
                $year  = isset($item['year']) ? $item['year']  : '';
                $title = isset($item['title']) ? $item['title']: '';
                $text  = isset($item['text']) ? $item['text']  : '';
                $image = isset($item['image']) ? $item['image']: '';
                if(empty($year) || empty($title) || empty($text) || empty($image)) continue;
              ?>
                <li class="splide__slide">
                  <div class="timeline-item">
                    <div class="row aic">
                      <?php if($title || $text || $year): ?>
                        <div class="timeline-item__content col-md-5">
                          <?php if($year): ?>
                            <div class="fs-display fwl t-gray-250 mb-3 year px-0 ps-rel"><?= $year ?></div>
                            <div class="years flex aic gap-1 mb-4-5">
                              <?php foreach ($years as $year_base) : ?>
                                <p class="mb-0 <?= $year_base === $year ? 't-secondary' : 't-gray-250' ?>"><?= $year_base ?></p>
                              <?php endforeach; ?>
                            </div>
                          <?php endif; if($title): ?>
                            <h3 class="timeline-item__title fwn mb-4"><?= $title ?></h3>
                          <?php endif; if($text) : ?>
                            <div class="timeline-item__text"><?= $text ?></div>
                          <?php endif; ?>
                        </div>
                      <?php endif; if($image) : ?>
                        <div class="timeline-item__image col-md-6 offset-md-1 ps-rel"
                          <?= isset($image['url']) && !empty($image['url']) ? 'style="background: var(--ld-light) url('.$image['url'].') no-repeat center / cover;"' : '' ?>
                        >
                          <?php if(isset($image['title'])): ?>
                            <div class="caption txt-ct t-primary ps-abs">
                              <p class="bg-white"><?= $image['title'] ?></p>
                            </div>
                          <?php endif; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>