<?php if (!defined('ABSPATH')) die('Access denied'); ?>
<?php if (have_rows('banner')) :while (have_rows('banner')) : the_row();
  $title      = get_sub_field('title') ? get_sub_field('title') : get_the_title();
  $headline   = get_sub_field('headline');
  $text       = get_sub_field('text');
  $button     = get_sub_field('button');
  $button_2   = get_sub_field('button_2');
  $background = get_sub_field('background');
  $video      = get_sub_field('video');
  if($title || $headline || $text || $button || $button_2 || $background || $video) :
?>
  <section class="secao-banner__home secao-banner__boat ovf-h ps-rel">
    <div class="banner__home ps-rel" style="background: url(<?= $background['url']; ?>) no-repeat center / cover;">
      <?php if($video):?>
        <video
          autoplay
          muted
          loop
          disablepictureinpicture
          disableremoteplayback
          playsinline
          data-poster="<?= $background['url'] ?>"
          data-src="<?= isset($video['url']) ? $video['url'] : '' ?>"
          class="z1 ps-abs inset-0 h-100 w-100 object-cover lozad"
          preload="none"
        >
          <source src="<?= $video_url ?>" type="video/mp4">
        </video>
      <?php endif; ?>
      <div class="overlay"></div>
      <div class="container">
        <div class="row jcc txt-ct ps-rel content aie">
          <div class="col-lg-6 description flex pb-6">
            <?php if($title) : ?>
              <h1 class="title fs-display fwl t-wh mb-0"><?= $title; ?></h1>
            <?php endif; ?>
            <div>
              <?php  if($text) : ?>
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
  </section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>