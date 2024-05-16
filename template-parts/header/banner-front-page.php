<?php if (!defined('ABSPATH')) die('Access denied'); ?>
<?php if (have_rows('banner')) : while (have_rows('banner')) : the_row();
  $titulo    = get_sub_field('titulo');
  $botao     = get_sub_field('botao');
  $imagens   = get_sub_field('imagens');
  $imagens_mobile = !empty(get_sub_field('imagens_mobile')) ? get_sub_field('imagens_mobile') : $imagens;
  
  if ($titulo || ldev_check_empty($imagens) || $botao) :
?>
<style>
  .secao-banner__home {
    --bg: url(<?= isset($imagens[0]['url']) ? $imagens[0]['url'] : '' ?>);
    --bg-mobile: url(<?= isset($imagens_mobile[0]['url']) ? $imagens_mobile[0]['url'] : '' ?>);
  }
  @media (width <= 600px) {
    .secao-banner__home {
      --bg: var(--bg-mobile)
    }
  }
</style>
  <section class="secao-banner__home ovf-h ps-rel">
    <div class="container">
      <div class="row aic py-4">
        <?php if ($titulo || $botao) : ?>
          <div class="col-lg-6 ps-rel content">
            <?php if ($titulo) : ?>
              <h1 class="mb-0 t-wh fwl"><?= $titulo ?></h1>
            <?php endif; if ($botao) : ldev_btn($botao, 'btn-secondary mt-4'); endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <?php if (ldev_check_empty($imagens)) : ?>
      <div class="imagens-banner splide">
        <div class="splide__track">
          <div class="splide__list">
            <?php foreach ($imagens as $c => $imagem) :
              $img_src      = "src='data:image/gif;base64,R0lGODlhAQABAAAAACw=' data-splide-lazy='".$imagem['url']."'";
              $size_medium = $imagem['sizes']['medium'];
              $size_mobile = $imagens_mobile[$c]['url'];
              $size_large  = $imagem['url'];
              $img_srcset   = "data-splide-lazy-srcset='$size_mobile 300w, $size_medium 500w, $size_large 768w'";
              $img_sizes    = "sizes='(max-width: 320px) 280px, (max-width: 768px) 720px, 768px'";
              $img_alt      = "alt='".($imagem['alt'] ? $imagem['alt'] : $imagem['title'])."'";
              $loading = "loading='lazy' fetchpriority='low' class='lozad'";
              if($c==0) $loading = "loading='eager' fetchpriority='high'";
            ?>
              <div class="splide__slide">
                <picture>
                  <?= "<source $img_srcset $img_sizes media='(min-width: 600px)' width='300' height='300' aria-hidden='true'/>" ?>
                  <img <?= "src='data:image/gif;base64,R0lGODlhAQABAAAAACw=' data-splide-lazy='$size_mobile' $loading $img_alt"?> />
                </picture>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>