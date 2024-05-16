<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_produtos')) : while(have_rows('secao_produtos')) : the_row();
  $titulo           = get_sub_field('titulo');
  $descricao        = get_sub_field('descricao');
  $headline         = get_sub_field('headline');
  $botao            = get_sub_field('botao');
  $exibir_categoria = get_sub_field('exibir_categorias');
  $produtos         = get_sub_field('produtos');
  
  if($exibir_categoria) {
    $args = [
      'taxonomy'   => 'categoria_produto',
      'hide_empty' => false,
      'fields'     => 'ids'
    ];
    $produtos = get_terms($args);
  }
  if($titulo && !empty($produtos)) :
?>
<div class="secao-produtos py-6 ps-rel">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 ais gap-y-2">
      <?php if($titulo || $headline || $descricao): ?>
        <div class="col-md-4 ps-rel">
          <div class="ps-sticky content">
            <?php if($headline): ?>
              <p class="headline mb-0"><?= $headline ?></p>
            <?php endif; if($titulo): ?>
              <h2 class="titulo ps-rel my-4 fwl h4 t-primary"><?= $titulo ?></h2>
            <?php endif; if($descricao) : ?>
              <div class="desc"><?= $descricao ?></div>
            <?php endif; if($botao) : ldev_btn($botao, 'btn-secondary mt-3'); endif; ?>
          </div>
        </div>
      <?php endif; if(!empty($produtos)) : ?>
        <div class="col-md-8 produtos pl-2">
          <div class="row row-cols-2 row-cols-md-2 row-cols-lg-3 gap-y-2">
            <?php foreach ($produtos as $i => $produto) : ?>
              <div class="col produto wow animate__fadeIn" data-wow-delay="<?= $i * .15 ?>s">
                <a href="<?= get_term_link($produto) ?>" class="link">
                  <div class="thumb mb-3 ovf-h border-radius">
                    <?= ldev_lazy_img(get_field('background', 'categoria_produto_' . $produto)['id']) ?>
                  </div>
                  <h3 class="titulo h5 fwn ff-headings"><?= get_term($produto)->name ?></h3>
                  <span class="fwn ff-headings">Saiba Mais</span>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
