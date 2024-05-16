<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_descricao')) : while(have_rows('secao_descricao')) : the_row();
  $titulo    = get_sub_field('titulo');
  $descricao = get_sub_field('descricao');
  $headline  = get_sub_field('headline');
  $botao     = get_sub_field('botao');
  $imagens   = get_sub_field('imagens');
  
  if($titulo || $descricao || $headline || $botao || !empty($imagens)) :
?>
<div class="secao-descricao py-9 ps-rel">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 jcb ais">
      <?php if($titulo || $headline || $descricao): ?>
        <div class="col-md-5 ps-rel wow animate__fadeInLeft">
          <?php if($headline): ?>
            <p class="headline mb-0">
              <?= $headline ?>
            </p>
          <?php endif; if($titulo): ?>
            <h2 class="titulo h4 ps-rel my-4 fwl h2 t-primary"><?= $titulo ?></h2>
          <?php endif; if($descricao) : ?>
            <div class="desc my-4"><?= $descricao ?></div>
          <?php endif; if($botao) : ldev_btn($botao, 'btn-secondary mt-3'); endif; ?>
        </div>
      <?php endif; if(!empty($imagens)) : ?>
        <div class="col-md-6 imagens ps-rel wow animate__fadeIn">
          <?php foreach ($imagens as $c => $imagem) : 
            $animation = $c * 0.2 . 's';
            $imgClass = 'wow animate__fadeInUp';
            if($c==0) $imgClass = ' animate__fadeInDown';
          ?>
            <?= ldev_lazy_img($imagem['id'], "border-radius ps-abs wow $imgClass", 'medium', [], "data-wow-delay='$animation'") ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
