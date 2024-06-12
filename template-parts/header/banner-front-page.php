<?php if (!defined('ABSPATH')) die('Access denied'); ?>
<?php if (have_rows('banner')) : ?>
  <section class="secao-banner__home ovf-h ps-rel">
    <div class="splide">
      <div class="splide__arrows ps-abs">
        <button class="splide__arrow splide__arrow--prev">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 42 42"><path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28.3584 20.8743h-14M21.3584 27.8743l-7-7 7-7"/></svg>
        </button>
        <button class="splide__arrow splide__arrow--next">
          <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.6416 21.1257L27.6416 21.1257" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M20.6416 14.1257L27.6416 21.1257L20.6416 28.1257" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </div>
      <div class="splide__track">
        <div class="splide__list">
          <?php $c=0; while (have_rows('banner')) : the_row();
            $title      = get_sub_field('title');
            $headline   = get_sub_field('headline');
            $text       = get_sub_field('text');
            $button     = get_sub_field('button');
            $button_2   = get_sub_field('button_2');
            $background = get_sub_field('background');
            $video      = get_sub_field('video');
            if($title || $headline || $text || $button || $button_2 || $background || $video ) :
          ?>
          <div class="splide__slide">
            <div class="banner__home ps-rel" style="background-image: url(<?= $background['url']; ?>);">
              <?php if($video) : ?>
                <video
                  <?= $c === 0 ? 'autoplay' : '' ?>
                  muted
                  loop
                  disablepictureinpicture
                  disableremoteplayback
                  data-poster="<?= $background['url'] ?>"
                  data-src="<?= $video['url'] ?>"
                  preload="none"
                  class="ps-abs inset-0 lozad" 
                >Desculpe, seu navegador não suporta vídeos incorporados, mas não se preocupe, você pode <a href="<?= $video['url'] ?>">baixá-lo</a>e assisti-lo com seu player de vídeo favorito!
                </video>
              <?php endif; ?>
              <div class="overlay"></div>
              <div class="container">
                <div class="row jcc txt-ct pb-6 ps-rel content aie">
                  <div class="col-lg-8">
                    <?php if($headline): ?>
                      <p class="t-wh fs-lg mb-1 t-up fwn"><?= $headline; ?></p>
                    <?php endif; if($title) : ?>
                      <h1 class="title fwl t-wh mb-0"><?= $title; ?></h1>
                    <?php endif; if($text) : ?>
                      <div class="text t-wh my-4 fwn"><?= $text; ?></div>
                    <?php endif; if(!empty($button) || !empty($button_2)): ?>
                      <div class="buttons gap-1 flex jcc aic mt-4">
                        <?php if($button) : ldev_btn($button, 'btn-white hover-secondary'); endif; ?>
                        <?php if($button_2) : ldev_btn($button_2, 'btn-outline white'); endif; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php $c++; endif; endwhile; ?>
        </div>
      </div>
    </div>
  </section>
<?php wp_reset_query(); wp_reset_postdata(); endif; ?>