<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_descricao')) : while(have_rows('secao_descricao')) : the_row();
  $titulo    = get_sub_field('titulo');
  $descricao = get_sub_field('descricao');
  $headline  = get_sub_field('headline');
  $imagem    = get_sub_field('imagem');
  
  if($titulo || $descricao || $headline || !empty($imagem)) :
?>
<div class="sobre-descricao bg-light py-9 ps-rel ovf-h">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 jcb aic">
      <?php if($titulo || $headline || $descricao): ?>
        <div class="col-md-5 ps-rel pr-4 wow animate__fadeInLeft">
          <?php if($headline): ?>
            <p class="headline mb-0">
              <?= $headline ?>
            </p>
          <?php endif; if($titulo): ?>
            <h2 class="titulo h4 ps-rel my-4 fwl h2 t-primary"><?= $titulo ?></h2>
          <?php endif; if($descricao) : ?>
            <div class="desc mt-4"><?= $descricao ?></div>
          <?php endif; ?>
        </div>
      <?php endif; if(!empty($imagem)) : ?>
        <div class="col-md-7 imagens ps-rel wow animate__fadeInRight">
          <?= ldev_lazy_img($imagem['id'], "border-radius", 'medium', []) ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
