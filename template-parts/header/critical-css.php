<?php
$arrContextOptions = ["ssl" => ["verify_peer" => false, "verify_peer_name" => true]];

// Função para carregar CSS
function load_css($path, $contextOptions) {
  echo file_get_contents(ldev_assets_url($path), false, stream_context_create($contextOptions));
}

// Array de configurações de CSS
$css_files = [
  'common'         => 'css/critical.css',
  'front_page'     => 'css/front-page-critical.css',
  'contact'        => 'css/contact-critical.css',
  'about'          => 'css/about-critical.css',
  'archive_boat'   => 'css/archive-boat-critical.css',
  'blog'           => 'css/blog-critical.css',
  'single_produto' => 'css/single-produto-critical.css',
  'single_post'    => 'css/single-post-critical.css',
  'find_a_dealer'  => 'css/find-a-dealer-critical.css',
  'responsive'     => 'css/responsive-critical.css',
];
?>

<style>
  :root{
    --ld-favicon-svg: url('data:image/svg+xml;base64,<?= base64_encode(ldev_favicon()) ?>')
  }
  /* Crítico */
  <?php
    load_css($css_files['common'], $arrContextOptions); 
    if (is_front_page()): 
      load_css($css_files['front_page'], $arrContextOptions);
    endif;
    if (is_page_template('page-templates/contact.php')): 
      load_css($css_files['contact'], $arrContextOptions);
    endif;
    if (is_page_template('page-templates/about.php')): 
      load_css($css_files['about'], $arrContextOptions);
    endif;
    if (is_post_type_archive('boat') || is_tax('boat_category')): 
      load_css($css_files['archive_boat'], $arrContextOptions);
    endif;
    if (is_home() || is_archive() || is_search() || is_paged()): 
      load_css($css_files['blog'], $arrContextOptions);
    endif;
    if (is_singular('produto')): 
      load_css($css_files['single_produto'], $arrContextOptions);
    endif;
    if (is_singular('post')): 
      load_css($css_files['single_post'], $arrContextOptions);
    endif;
    if (is_page_template('page-templates/find-a-dealer.php')): 
      load_css($css_files['find_a_dealer'], $arrContextOptions);
    endif;
  ?>
  /* Responsivo */
  @media (width <= 991px) {
    <?php load_css($css_files['responsive'], $arrContextOptions); ?>
  }
</style>