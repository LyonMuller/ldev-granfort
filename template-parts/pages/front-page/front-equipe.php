<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_equipe')) : while(have_rows('secao_equipe')) : the_row();
  $imagens   = get_sub_field('imagens');
  $titulo    = get_sub_field('titulo');
  $descricao = get_sub_field('descricao');
  $botao     = get_sub_field('botao');
  
  if($titulo || $imagens || $descricao || $botao) :
?>
<div class="secao-equipe ps-rel ovf-h">
  <div class="container py-3 mb-6 bg-primary ps-rel ovf-h border-radius">
    <?php if(!empty($imagens)): ?>
      <div class="imagens ps-abs">
        <?php foreach($imagens as $imagem) : ?>
          <?= ldev_lazy_img($imagem['id'], 'ps-abs', 'full') ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <div class="row jce gap-y-2 jcc aic">
      <div class="col-md-6 px-3 border-radius py-3 bg-gradient wow animate__fadeInRight">
        <?php if($titulo): ?>
          <h2 class="titulo ps-rel mb-0 h4 fwl t-wh"><?= $titulo ?></h2>
        <?php endif; if($descricao) : ?>
          <div class="t-wh my-4"><?= $descricao ?></div>
        <?php endif; if($botao) : ldev_btn($botao, 'btn-outline-white'); endif; ?>
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
