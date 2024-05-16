<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_desenvolvimento')) : while(have_rows('secao_desenvolvimento')) : the_row();
  $background = get_sub_field('background');
  $titulo     = get_sub_field('titulo');
  $descricao  = get_sub_field('descricao');
  
  if($titulo  || $descricao) :
?>
<div class="sobre-desenvolvimento ps-rel ovf-h bg-primary"
    <?php if($background): ?>
      style="background: url(<?= $background['url'] ?>) no-repeat center / cover;"
    <?php endif; ?>
>
  <div class="container py-6 ps-rel ovf-h border-radius">
    <div class="row gap-y-2 aic">
      <div class="col-md-6 px-3 border-radius py-3 bg-gradient wow animate__fadeIn">
        <?php if($titulo): ?>
          <h2 class="titulo ps-rel mb-0 h4 fwl t-wh"><?= $titulo ?></h2>
        <?php endif; if($descricao) : ?>
          <div class="t-wh mt-4"><?= $descricao ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
