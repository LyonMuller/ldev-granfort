<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_sustentavel')) : while(have_rows('secao_sustentavel')) : the_row();
  $titulo    = get_sub_field('titulo');
  $descricao = get_sub_field('descricao');
  $headline  = get_sub_field('headline');
  $botao     = get_sub_field('botao');
  $logos   = get_sub_field('logos');
  
  if($titulo || $descricao || $headline || $botao || !empty($logos)) :
?>
<div class="secao-sustentavel pb-6 pt-4 ps-rel">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 jcb aic">
      <?php if($titulo || $headline || $descricao): ?>
        <div class="col-md-4 ps-rel wow animate__fadeInLeft">
          <?php if($headline): ?>
            <div class="headline mb-0">
              <?= $headline ?>
            </div>
          <?php endif; if($titulo): ?>
            <h2 class="titulo h4 ps-rel my-4 fwl h2 t-primary"><?= $titulo ?></h2>
          <?php endif; if($descricao) : ?>
            <div class="desc my-4"><?= $descricao ?></div>
          <?php endif; if($botao) : ldev_btn($botao, 'btn-secondary mt-3'); endif; ?>
        </div>
      <?php endif; if(!empty($logos)) : ?>
        <div class="col-md-6 logos ps-rel wow animate__fadeIn">
          <div class="row row-cols-2 ais itens">
            <?php foreach ($logos as $c => $imagem) : ?>
              <div class="item flex aic jcc border light-100 wow animate__fadeIn" data-wow-delay="<?= $c * .25 . 's' ?>">
                <?= ldev_lazy_img($imagem['id'], "border-radius", 'full', []) ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
