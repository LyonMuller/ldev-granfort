<?php 
  if(!defined('ABSPATH')) die('Access denied');

  $imagem    = get_field('imagem');
  $dimensoes = get_field('dimensoes');
  $descricao = get_field('descricao');
  $aplicacao = get_field('aplicacao');
  $botao     = !empty(get_field('botao')) ? get_field('botao') : ['title' => 'Solicite um Orçamento', 'url' => '#popup'];

  if($imagem || $dimensoes || $descricao || $aplicacao || $botao):
?>
<section class="container pt-3 pb-6 border-bottom light-100 produto-descricao">
  <div class="row row-cols-1 row-cols-md-2">
    <?php if($imagem): ?>
      <div class="col-sm-6 col-md-5 produto-img ps-rel">
        <div class="splide splide-galeria">
          <div class="splide__track">
            <ul class="splide__list">
              <?php foreach ($imagem as $img) : ?>
                <li class="splide__slide border-radius ovf-h">
                  <?= ldev_lazy_img($img['id'], 'border-radius aspect-square w-100', 'full') ?>
                </li>              
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <!-- Thumbnails -->
        <?php if(count($imagem) > 1): ?>
          <ul class="thumbnails flex aic ovf-h mt-3 gap-1 mb-0">
            <?php foreach ($imagem as $img) : ?>
              <li class="thumbnail">
                <?= ldev_lazy_img($img['id'], 'border-radius aspect-square w-100', 'thumbnail') ?>
              </li>              
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
      <?php // <div class="regua" title="Régua Virtual em Milímetros para Auxiliar. Pode haver variações"><div class="marcacao" data-number="10" style="--_left: 1;"></div></div> ?>
    <?php endif; ?>
    <div class="col offset-lg-1">
      <h1 class="h3 fwl mb-0"><?= get_the_title() ?></h1>
      <?php if($dimensoes): ?>
        <p class="ff-headings dimensoes px-1 border-radius border light-100 mt-4 bg-light d-inline-block mb-0"><b class="t-secondary">Dimensões:</b> <?= $dimensoes ?></p>
      <?php endif;if($descricao): ?>
        <div class="mt-4 ff-headings"><?= $descricao ?></div>
      <?php endif; if($aplicacao):
        $titulo = isset($aplicacao['titulo']) ? $aplicacao['titulo'] : '';
        $itens = isset($aplicacao['itens']) ? $aplicacao['itens'] : '';
        if($titulo && $itens) :
      ?>
        <h3 class="ff-headings mt-4 h5 t-secondary fwl"><?= $titulo ?></h3>
        <ul class="fs-sm ff-headings">
          <?php foreach ($itens as $item) : ?>
            <li><?= $item['descricao'] ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; endif; if($botao): ?>
        <?= ldev_btn($botao, 'btn-secondary mt-3') ?>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const option = document.querySelector('.choicesjs-select option');
    const value = <?= get_the_ID() ?>;
    const title = '<?= get_the_title() ?>';
    option.value = value;
    option.text = title;
});
</script>
