<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_descricao_2')) : while(have_rows('secao_descricao_2')) : the_row();
  $titulo           = get_sub_field('titulo');
  $titulo_destacado = get_sub_field('titulo_destacado');
  $descricao        = get_sub_field('descricao');
  $botao            = get_sub_field('botao');
  $imagens          = get_sub_field('imagens');
  
  if($titulo || $descricao || $titulo_destacado || $botao || !empty($imagens)) :
?>
<div class="secao-descricao secao-descricao__sobre bg-light py-4 pb-12 ps-rel ovf-h">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 jcb ais">
      <?php if(!empty($imagens)) : ?>
        <div class="col-md-6 imagens ps-rel wow animate__fadeIn">
          <?php foreach ($imagens as $c => $imagem) : 
            $animation = $c * 0.2 . 's';
            $imgClass = 'wow animate__fadeInUp';
            if($c==0) $imgClass = ' animate__fadeInDown';
          ?>
            <?= ldev_lazy_img($imagem['id'], "border-radius ps-abs wow $imgClass", 'medium', [], "data-wow-delay='$animation'") ?>
          <?php endforeach; ?>
        </div>
      <?php endif; if($titulo || $titulo_destacado || $descricao): ?>
        <div class="col-md-5 ps-rel wow animate__fadeInRight">
          <?php if($titulo): ?>
            <h2 class="titulo h4 ff-headings ps-rel my-4 fwn t-body"><?= $titulo ?></h2>
          <?php endif; if($descricao) : ?>
            <div class="desc my-4"><?= $descricao ?></div>
          <?php endif; if($titulo_destacado) : ?>
            <h3 class="titulo h5 ff-headings ps-rel my-4 fwn t-body"><?= $titulo_destacado ?></h3>
          <?php endif; ?>
        </div>
      <?php endif;?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
