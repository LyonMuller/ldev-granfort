<?php if (!defined('ABSPATH')) die('Access denied'); ?>
<?php if (have_rows('banner')) : while (have_rows('banner')) : the_row();
  $title      = get_sub_field('title') ? get_sub_field('title'): get_the_title();
  $text       = get_sub_field('text');
  $background = get_sub_field('background');
  
  if ($title || $text || $background) :
?>
  <section class="secao-banner__sobre ovf-h ps-rel bg-primary"
    <?= isset($background['url']) && !empty($background) ? 'style="--bg: url('.$background['url'].');"' : '' ?>
  >
    <div class="container">
      <div class="row aic py-4 jcc">
        <?php if ($title || $text || $botao) : ?>
          <div class="col-lg-10 ps-rel pb-9 content txt-ct">
            <?php if ($title) : ?>
              <h1 class="mb-3 fs-display-2 t-wh fwl"><?= $title ?></h1>
            <?php endif; if ($text) : ?>
              <div class="t-wh fs-lg"><?= $text ?></div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>