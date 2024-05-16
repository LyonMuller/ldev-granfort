<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_timeline')) : ?>
<section class="sobre-timeline">
  <div class="container">
    <?php
      while(have_rows('secao_timeline')) : the_row();
        $ano       = get_sub_field('ano');
        $titulo    = get_sub_field('titulo');
        $descricao = get_sub_field('descricao');
        $headline  = get_sub_field('headline');
        $imagem    = get_sub_field('imagem');
        
        if($ano && ($titulo || $descricao || $headline) && !empty($imagem)) :
      ?>
      <div class="row ais item py-6 ps-rel">
        <?php if($ano): ?>
          <div class="col-3 col-md-1 wow animate__fadeInUp ps-rel ano-cont">
            <div class="aspect-square border-radius bg-light flex aic jcc ano">
              <p class="h6 t-secondary fwb"><?= $ano ?></p>
            </div>
          </div>
        <?php endif; if($imagem || $titulo || $descricao || $headline) : ?>
          <div class="col-9 col-md-11">
            <div class="row descricao">
              <?php if($titulo || $headline || $descricao): ?>
                <div class="col-md-6 ps-rel pr-4 wow animate__fadeInUp flex aic">
                  <div class="w-100">
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
                </div>
              <?php endif; if(!empty($imagem)) : ?>
                <div class="col-md-5 ps-rel wow animate__fadeInUp imagem">
                  <?= ldev_lazy_img($imagem['id'], "border-radius aspect-square", 'medium', []) ?>
                </div>
              <?php endif;  ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; endwhile;?>
  </div>
</section>
<?php wp_reset_query(); wp_reset_postdata(); endif; ?>
