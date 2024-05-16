<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_depoimentos')) : while(have_rows('secao_depoimentos')) : the_row();
$headline    = get_sub_field('headline');
$titulo      = get_sub_field('titulo');
$depoimentos = get_sub_field('depoimentos');

if($titulo || $headline || !empty($depoimentos)) :
?>
<div class="sobre-depoimentos bg-light ps-rel ovf-h pt-3 pb-6">
  <div class="container">
    <div class="row jcc">
      <?php if($titulo || $headline): ?>
        <div class="col-md-7 mb-5 txt-ct">
          <?php if($headline): ?>
            <p class="headline wow animate__fadeInUp"><?= $headline ?></p>          
          <?php endif; if($titulo) : ?>
            <h2 class="mb-0 h4 fwl titulo-span-secondary wow animate__fadeInUp"><?= $titulo ?></h2>
          <?php endif; ?>
        </div>
      <?php endif; if(!empty($depoimentos)) : ?>
        <div class="splide depoimentos-slider wow animate__fadeInUp col-md-12" data-wow-delay=".5s" aria-label="Nossos Clientes">
          <div class="splide__track">
            <div class="splide__list">
              <?php foreach ($depoimentos as $i => $depoimento) :
                $imagem    = isset($depoimento['avatar'])  ? $depoimento['avatar']['id'] : '';
                $descricao = isset($depoimento['texto'])   ? $depoimento['texto'] : '';
                $nome      = isset($depoimento['nome'])    ? $depoimento['nome'] : '';
                $cargo     = isset($depoimento['empresa']) ? $depoimento['empresa'] : '';
                if($imagem || $descricao || $nome || $cargo) :
              ?>
                <div class="splide__slide my-4">
                  <blockquote class="mb-0 gap-1">
                    <div class="avatar-cont ps-rel">
                      <?= ldev_lazy_img($imagem, 'border-radius-lg aspect-square mb-3', 'thumbnail', ['width' => 96, 'height' => 96]) ?>
                    </div>
                    <?php if($descricao): ?>
                      <div class="my-4 quote ff-headings fwn"><?= $descricao ?></div>
                    <?php endif; if($nome || $cargo) : ?>
                      <cite class="flex fs-sm aic gap-0-5 flex-wrap">
                        <?php if($nome): ?>
                          <p class="mb-0 ff-headings t-gray fwl"><?= $nome ?></p>
                        <?php endif; if($cargo): ?>
                          <span>|</span>
                          <p class="mb-0 t-secondary t-up fwb"> <?= $cargo ?></p>
                        <?php endif; ?>
                      </cite>
                    <?php endif; ?>
                  </blockquote>
                </div>                
              <?php endif; endforeach; ?>
            </div>
          </div>
          <div class="splide__arrows flex jcc gap-1 aic splide__arrows--ltr mt-5">
            <button class="splide__arrow t-gray aic t-up splide__arrow--prev" type="button" aria-label="Retroceder" aria-controls="splide01-track" disabled="">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 12L6 8L10 4" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Retroceder
            </button>            
            <button class="splide__arrow t-gray aic t-up splide__arrow--next" type="button" aria-label="Avançar" aria-controls="splide01-track">
              Avançar
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 12L10 8L6 4" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>
          </div>
        </div>
      <?php endif;?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
