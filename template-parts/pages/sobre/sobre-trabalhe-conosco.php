<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_trabalhe_conosco')) : while(have_rows('secao_trabalhe_conosco')) : the_row();
  $titulo     = get_sub_field('titulo');
  $headline   = get_sub_field('headline');
  $descricao  = get_sub_field('descricao');
  $imagem     = get_sub_field('imagem');
  $formulario = get_sub_field('formulario');
  $botao      = get_sub_field('botao');

  if($titulo || ldev_check_empty($formulario) || ldev_check_empty($botao) || $headline || $imagem) :
?>
<div class="sobre-trabalhe-conosco py-6 ps-rel" id="trabalhe-conosco">
  <div class="container">
    <div class="row row-cols-sm-1 row-cols-md-2 gap-y-2 jcc ais">
      <?php if($titulo || $headline || $imagem || ldev_check_empty($botao)): ?>
        <div class="col-md-5 mb-4 wow animate__fadeInLeft ps-rel">
          <div class="ps-sticky">
            <?php if($imagem) : ?>
              <?= ldev_lazy_img($imagem['id'], 'mb-4 border-radius', 'medium') ?>
            <?php endif; if($headline): ?>
              <p class="headline ps-rel mb-3 fwl"><?= $headline ?></p>
            <?php endif; if($titulo): ?>
              <h2 class="titulo ps-rel mb-0 h4 fwl"><?= $titulo ?></h2>
            <?php endif; if($descricao): ?>
              <div class="descricao ps-rel mt-3 fwl"><?= $descricao ?></div>
            <?php endif; if($botao) : ldev_btn($botao, 'btn-secondary mt-3'); endif; ?>
          </div>
        </div>
      <?php endif; if(ldev_check_empty($formulario)) :
        $titulo     = isset($formulario['titulo']) ? $formulario['titulo']: '';
        $formulario = isset($formulario['formulario']) ? $formulario['formulario'] : '';
        if(empty($titulo) && empty($formulario)) continue;
      ?>
        <div class="col-md-7 wow animate__fadeInUp">
          <div class="bg-light px-2 py-2 border-radius">
            <?php if($titulo): ?>
              <h3 class="h5 fwl mb-4 t-secondary"><?= $titulo ?></h3>
            <?php endif; ?>
            <?= ldev_form_wp($formulario) ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
