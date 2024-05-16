<?php 
  $imagem = !empty(get_field('imagem')) ? get_field('imagem')[0] : null;
  $titulo = get_the_title();
  $categoria = !empty(get_the_terms($post->ID, 'categoria_produto')) ? get_the_terms($post->ID, 'categoria_produto')[0] : null;
?>
<div class="col produto-listagem my-4">
  <a href="<?= get_the_permalink() ?>">
    <div class="produto-listagem__imagem ovf-h border-radius ps-rel">
      <?php if($categoria): ?>
        <p class="categoria ps-abs bg-white border-radius-sm ff-headings fsn"><?= $categoria->name ?></p>
      <?php endif; ?>
      <?= ldev_lazy_img($imagem['id'], 'border-radius w-100', 'thumbnail') ?>
    </div>
    <div class="produto-listagem__conteudo">
      <h3 class="h5 my-3 fwl ff-headings"><?= $titulo ?></h3>
      <span class="btn-outline-primary">Ver Produto</span>
    </div>
  </a>
</div>