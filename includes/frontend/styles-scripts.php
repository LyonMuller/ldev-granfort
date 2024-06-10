<?php
// add style on admin page
function ldev_admin_styles() {
  wp_enqueue_style('ldev-admin-styles', ldev_assets_url('css/admin.css'), [], ldev_ver(ldev_assets_url('css/admin.css')), 'all');
  // wp_enqueue_style('ldev-fonts', "https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600&family=Barlow+Semi+Condensed:wght@400;500;700&family=Barlow:ital,wght@0,300;0,600;0,700;1,800&display=swap");
}
add_action('admin_enqueue_scripts', 'ldev_admin_styles');

if (!is_admin()) {
  /**
   * Adiciona Atributos Personalizados nos scripts
   * @author Lyon Müller
   * @package Functions
   * @subpackage Layout
   */
  function ldev_script_loader($tag, $handle) {
    foreach (['async', 'defer'] as $attr) {
      if (!wp_scripts()->get_data($handle, $attr)) {
        continue;
      }
      if (!preg_match(":\s$attr(=|>|\s):", $tag)) {
        $tag = preg_replace(':(?=></script>):', " $attr", $tag, 1);
      }
      // Only allow async or defer, not both.
      break;
    }
    return $tag;
  }
  add_filter('script_loader_tag', 'ldev_script_loader', 10, 2);

  /**
   * Carrega Fontes com Preconnect no Header
   * @author Lyon Müller
   * @package Functions
   * @subpackage Layout
   */

  function ldev_fontes_head() {
    $banner = get_field('banner');
    $imagem = isset($banner[0]['background']['url']) ? $banner[0]['background']['url'] :
              (isset($banner['background']['url']) ? $banner['background']['url'] : (isset($banner['background']) ? $banner['background']['url'] : ''));
    $ext = pathinfo($imagem, PATHINFO_EXTENSION);
    $type = 'image/'.$ext;

  ?>
  <?php if($imagem): ?><link rel="preload" href="<?= $imagem ?>" fetchpriority="high" as="image" type="<?= $type ?>"><?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php
  }
  add_action('wp_head', 'ldev_fontes_head', 10, 1);


  /**
   * Faz o registros dos estilos
   * @author Lyon Müller
   * @package Functions
   * @subpackage Layout
   */

  function ldev_scripts() {
    wp_dequeue_script('jquery');
    wp_register_script('ldev-lazy-load',  ldev_assets_url('js/lazy-load.min.js'), [], ldev_ver(ldev_assets_url('js/lazy-load.min.js')), true);
    wp_register_script('ldev-bs',  ldev_assets_url('js/bootstrap.min.js'), [], ldev_ver(ldev_assets_url('js/bootstrap.min.js')), true);
    wp_register_style('ldev-style',       ldev_assets_url('css/style.css'),       [], ldev_ver(ldev_assets_url('css/style.css')), 'print');

    wp_register_style('ldev-front-page',  ldev_assets_url('css/front-page.css'),   [], ldev_ver(ldev_assets_url('css/front-page.css')), 'print');
    wp_register_script('front-page',      ldev_assets_url('js/front-page.min.js'), ['jquery'], ldev_ver(ldev_assets_url('js/front-page.min.js')), true);
    
    wp_register_script('ldev-blog',      ldev_assets_url('js/blog.min.js'), [], ldev_ver(ldev_assets_url('js/blog.min.js')), true);

    wp_register_style('ldev-sobre',  ldev_assets_url('css/sobre.css'),   [], ldev_ver(ldev_assets_url('css/sobre.css')), 'print');
    wp_register_script('ldev-sobre', ldev_assets_url('js/sobre.min.js'), ['jquery'], ldev_ver(ldev_assets_url('js/sobre.min.js')), true);
    
    wp_register_style('ldev-single-post',        ldev_assets_url('css/single-post.css'),        [], ldev_ver(ldev_assets_url('css/single-post.css')), 'print');
    
    wp_register_style('ldev-single-post',        ldev_assets_url('css/single-post.css'),        [], ldev_ver(ldev_assets_url('css/single-post.css')), 'print');
    
    wp_register_style('ldev-single-produto',  ldev_assets_url('css/produto.css'),     [], ldev_ver(ldev_assets_url('css/produto.css')), 'print');
    wp_register_script('ldev-single-produto', ldev_assets_url('js/produto.min.js'), [], ldev_ver(ldev_assets_url('js/produto.min.js')), true);

    wp_register_style('ldev-contato',  ldev_assets_url('css/contato.css'),   [], ldev_ver(ldev_assets_url('css/contato.css')), 'print');
    wp_register_script('ldev-contato', ldev_assets_url('js/contato.min.js'), [], ldev_ver(ldev_assets_url('js/contato.min.js')), true);

    wp_register_style('ldev-produtos',  ldev_assets_url('css/produtos.css'),   [], ldev_ver(ldev_assets_url('css/produtos.css')), 'print');
    wp_register_script('ldev-produtos', ldev_assets_url('js/produtos.min.js'), [], ldev_ver(ldev_assets_url('js/produtos.min.js')), true);
  }
  add_action('wp_enqueue_scripts', 'ldev_scripts', 1000);
  

  /**
   * Precarrega os Assets Mais Críticos
   * @author Lyon Müller
   * @package Functions
   * @subpackage Layout
   */

  //  add_action( 'init', function () {
  //     $logo_url = ldev_logo_url();
  //     $preload_files[] = $logo_url ?? "<$logo_url>; rel=preload; as=image";

  //     $preload_files = implode(',',$preload_files);
  //     header('Link: ' . $preload_files);
  //  });

  /**
   * Faz as resquisições de CSS no Footer
   * @author Lyon Müller
   * @package Functions
   * @subpackage Layout
   */

  function ldev_footer_styles() {

    if (is_front_page()) :
      wp_enqueue_style('ldev-front-page');
      wp_enqueue_script('front-page');
    endif;

    if (is_home())
      wp_enqueue_script('ldev-blog');

    if (is_page_template('page-templates/contato.php')):
      wp_enqueue_style('ldev-contato');
      wp_enqueue_script('ldev-contato');
    endif;

    if (is_page_template('page-templates/sobre.php')) :
      wp_enqueue_style('ldev-sobre');
      wp_enqueue_script('ldev-sobre');
    endif;

    if (is_page_template('page-templates/planos.php')) :
      wp_enqueue_style('ldev-planos');
      wp_enqueue_script('ldev-planos');
    endif;

    if (is_page_template('page-templates/suporte.php'))
      wp_enqueue_style('ldev-suporte');

    if (is_singular('solucao')) :
      wp_enqueue_style('ldev-single-solucao');
      wp_enqueue_script('ldev-single-solucao');
    endif;
    
    if (is_post_type_archive('produto') || is_tax('categoria_produto')) :
      wp_enqueue_style('ldev-produtos');
    endif;

    if (is_singular('post'))
      wp_enqueue_style('ldev-single-post');

    if (is_singular('produto')) :
      wp_enqueue_script('ldev-single-produto');
    endif;
    // CSS
    wp_enqueue_style('ldev-style');

    // Plugins
    wp_enqueue_script('ldev-bs');
    wp_enqueue_script('jquery');
    wp_enqueue_script('main-js',    ldev_assets_url('js/main.min.js'), ['jquery'], ldev_ver(ldev_assets_url('js/main.min.js')), true);
    wp_enqueue_script('ldev-lazy-load');

    $scripts_to_defer = [
      'ldev-lazy-load',
      'main-js',
      'front-page',
      'wpforms',
      'choicesjs',
      'recaptcha',
      'wpforms-smart-phone-field',
    ];
    foreach($scripts_to_defer as $script) {
      wp_script_add_data($script, 'defer', true);
    }

  }
  add_action('wp_footer', 'ldev_footer_styles');

  /**
   * Remove o Jquery Migrate do Front-end
   * @author Lyon Müller
   * @package Functions
   * @subpackage Layout
   */
  function ldev_remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
      $script = $scripts->registered['jquery'];
      if ($script->deps) {
        $script->deps = array_diff($script->deps, array('jquery-migrate'));
      }
    }
  }
  add_action('wp_default_scripts', 'ldev_remove_jquery_migrate');

  function ldev_add_defer_scripts($tag, $handle) {
    $defer_scripts = array(
      'ldev-lazy-load',
      'front-page',
      'main-js',
      'jquery-core',
      'wpforms',
      'wpforms-choicesjs',
    );
    if (in_array($handle, $defer_scripts)) {
      return str_replace("type='text/javascript'", "type='text/javascript' defer", $tag);
    }
    return $tag;
  }
  add_filter('script_loader_tag', 'ldev_add_defer_scripts', 10, 2);

  function ldev_add_defer_styles($tag, $handle) {
    $defer_styles = array(
      'ldev-style',
      'ldev-front-page',
      'ldev-sobre',
      'ldev-produtos',
      'ldev-suporte',
      'ldev-contato',
      'ldev-single-produto',
    );

    if (in_array($handle, $defer_styles)) {
      $tag = str_replace('rel=', 'onload="this.media=\'all\'; this.onload=null;" rel=', $tag);
    }
    return $tag;
  }
  add_filter('style_loader_tag', 'ldev_add_defer_styles', 10, 2);
}
