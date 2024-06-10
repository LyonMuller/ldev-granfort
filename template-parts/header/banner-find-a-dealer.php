<?php if (!defined('ABSPATH')) die('Access denied'); ?>
<?php if (have_rows('banner')) : while (have_rows('banner')) : the_row();
    $background = get_sub_field('background');
    $title      = get_sub_field('title') ? get_sub_field('title') : get_the_title();
    if ($background || $title) :
?>
  <section class="secao-banner__contato ovf-h ps-rel" style="--bg: url(<?= $background['url'] ?>)">
    <div class="container z1 ps-rel py-12">
      <div class="row jcc txt-ct">
        <div class="col-lg-10">
          <h1 class="h1 fwl mb-0 t-wh"><?= $title ?></h1>
        </div>
      </div>
    </div>
  </section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>