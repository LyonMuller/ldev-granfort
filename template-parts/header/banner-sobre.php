<?php if (!defined('ABSPATH')) die('Access denied'); ?>
<?php if (have_rows('banner')) : while (have_rows('banner')) : the_row();
  $headline   = get_sub_field('headline');
  $titulo     = get_sub_field('titulo') ? get_sub_field('titulo') : get_the_title();
  $descricao  = get_sub_field('descricao');
  $botao      = get_sub_field('botao');
  $background = get_sub_field('background');
  
  if ($titulo || $descricao || $background || $botao) :
?>
  <section class="secao-banner__sobre ovf-h ps-rel bg-primary" style="--bg: url(<?= isset($background['url']) ? $background['url'] : '' ?>)">
    <div class="container">
      <div class="row aic py-4">
        <?php if ($titulo || $descricao || $botao) : ?>
          <div class="col-lg-6 ps-rel content">
            <?php if ($headline) : ?>
              <p class="mb-4 headline t-wh fwl"><?= $headline ?></p>
            <?php endif; if ($titulo) : ?>
              <h1 class="mb-0 h2 t-wh fwl"><?= $titulo ?></h1>
            <?php endif; if ($descricao) : ?>
              <div class="my-4 t-wh fwl"><?= $descricao ?></div>
            <?php endif; if ($botao) : ldev_btn($botao, 'btn-secondary'); endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>