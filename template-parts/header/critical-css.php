<?php $arrContextOptions=["ssl"=>["verify_peer"=>false,"verify_peer_name"=>true]];?>
<style>
  /* Crítico */
  <?= file_get_contents(ldev_assets_url('css/critical.css'), false, stream_context_create($arrContextOptions)); ?>
  
  <?php if(is_front_page()): ?>
    <?= file_get_contents(ldev_assets_url('css/front-page-critical.css'), false, stream_context_create($arrContextOptions)); ?>  
  <?php endif; if(is_page_template('page-templates/contato.php')) : ?>
    <?= file_get_contents(ldev_assets_url('css/contato-critical.css'), false, stream_context_create($arrContextOptions)); ?>
  <?php endif; if(is_post_type_archive('produto') || is_tax('categoria_produto')) : ?>
    <?= file_get_contents(ldev_assets_url('css/produtos-critical.css'), false, stream_context_create($arrContextOptions)); ?>
  <?php endif; if(is_home() || is_archive() || is_search() || is_paged()) : ?>
    <?= file_get_contents(ldev_assets_url('css/blog-critical.css'), false, stream_context_create($arrContextOptions)); ?>
  <?php endif; if(is_singular('produto')) : ?>
    <?= file_get_contents(ldev_assets_url('css/single-produto-critical.css'), false, stream_context_create($arrContextOptions)); ?>
  <?php endif; if(is_singular('post')) : ?>
    <?= file_get_contents(ldev_assets_url('css/single-post-critical.css'), false, stream_context_create($arrContextOptions)); ?>
  <?php endif; if(is_page_template('page-templates/sobre.php')): ?>
    <?= file_get_contents(ldev_assets_url('css/sobre-critical.css'), false, stream_context_create($arrContextOptions)); ?>
  <?php endif; ?>

  /* Responsive */
  @media (width <= 991px){
    <?= file_get_contents(ldev_assets_url('css/responsive-critical.css'), false, stream_context_create($arrContextOptions)); ?>
  }
</style>