<?php 
  $headline    = get_theme_mod('ldev_products_cta_headline');
  $titulo      = get_theme_mod('ldev_products_cta_title');
  $descricao   = get_theme_mod('ldev_products_cta_description');
  $botao_texto = get_theme_mod('ldev_products_cta_button_text');
  $botao_link  = get_theme_mod('ldev_products_cta_button_link');
  if($headline || $titulo || $descricao || $botao_texto || $botao_link):
?>
<div class="col cta my-4 flex">
  <div class="bg-gradient w-100 px-2 py-3 h-100 border-radius">
    <?php if($headline): ?>
      <p class="t-wh headline"><?= $headline; ?></p>
    <?php endif; if($titulo) : ?>
      <h2 class="t-wh h5 fwl my-3"><?= $titulo; ?></h2>
    <?php endif; if($descricao) : ?>
      <div class="t-wh ff-headings my-3"><?= $descricao; ?></div>
    <?php endif; if($botao_texto && $botao_link) : ?>
      <?= ldev_btn(['url'=> get_permalink($botao_link), 'title' => $botao_texto], 'btn-outline-white') ?>
    <?php endif; ?>
  </div>    
</div>
<?php endif; ?>