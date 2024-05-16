<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_sobre')) : while(have_rows('secao_sobre')) : the_row();
  $titulo    = get_sub_field('titulo');
  $descricao = get_sub_field('descricao');
  $headline  = get_sub_field('headline');
  $botao     = get_sub_field('botao');
  $botao_2   = get_sub_field('botao_2');
  $imagem    = get_sub_field('imagem');
  
  if($titulo || $descricao || $headline || $botao || $botao_2 || $imagem) :
?>
<div class="secao-sobre py-6 ps-rel bg-light ovf-h">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 aic">
      <?php if($imagem) : ?>
        <div class="col-md-6 wow animate__fadeInLeft">
          <?= ldev_lazy_img($imagem['id'], 'border-radius') ?>
        </div>
      <?php endif; if($titulo || $headline || $descricao): ?>
        <div class="col-md-6 pl-2 ps-rel wow descricao animate__fadeInRight">
          <?php if($headline): ?>
            <div class="h5 fwl titulo mb-0">
              <?= $headline ?>
              <hr class="my-4">
            </div>
          <?php endif; if($titulo): ?>
            <h2 class="titulo ps-rel mb-4 fwl h2 t-primary"><?= $titulo ?></h2>
          <?php endif; if($descricao) : ?>
            <div class="desc my-4"><?= $descricao ?></div>
          <?php endif; if($botao) : ldev_btn($botao, 'btn-secondary mt-3'); endif; if($botao_2) : ldev_btn($botao_2, 'btn-outline-primary mt-3 ml-3'); endif; ?>
        </div>
      <?php endif;  ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
