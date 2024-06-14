<?php if(!defined('ABSPATH')) die('Access denied');

/**
 * Suporte Nativo WordPress
 */
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'custom-logo');
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'dark-editor-style' );

/**
 * Adiciona suporte a SVG e WebP nos uploads do WordPress.
 * Autor: Lyon.dev
 *
 * @param array $mimes Tipos MIME permitidos nos uploads.
 * @return array Tipos MIME atualizados.
 */
function ldev_add_upload_mimes($mimes) {
  // Adiciona suporte para SVG
  $mimes['svg'] = 'image/svg+xml';

  // Adiciona suporte para WebP
  $mimes['webp'] = 'image/webp';

  return $mimes;
}
add_filter('upload_mimes', 'ldev_add_upload_mimes');

/**
 * Adiciona suporte a visualização de miniaturas WebP.
 * Autor: Lyon.dev
 *
 * @param array $mime_types Tipos MIME das miniaturas existentes.
 * @return array Tipos MIME atualizados.
 */
function ldev_add_webp_to_thumbnail_mime_types($mime_types) {
  // Adiciona suporte para WebP nas miniaturas
  $mime_types['webp'] = 'image/webp';

  return $mime_types;
}
add_filter('wp_generate_attachment_metadata', 'ldev_add_webp_to_thumbnail_mime_types');

/**
 * Altera a logo do WordPress na tela de login e o link associado a ela.
 * Autor: Lyon.dev_
 */
function ldev_custom_login_logo() {
  // URL da imagem da nova logo
  $logo_url = ldev_logo_url();

  echo 
  '<style type="text/css">
    .login h1 a {
      background-image: url(' . $logo_url . ') !important;
      width: auto !important;
      background-size: contain !important;
      margin-bottom: .5rem;
      height: auto;
    }
    .login h1 a:hover {
      background-color: transparent !important;
    }
  </style>';
}
add_action('login_head', 'ldev_custom_login_logo');

/**
 * Altera o link associado à logo do WordPress na tela de login.
 * Autor: Lyon.dev_
 *
 * @return string URL da Página inicial do site.
 */
function ldev_custom_login_logo_url() {
  return home_url('/');
}
add_filter('login_headerurl', 'ldev_custom_login_logo_url');

/**
 * Altera o título do atributo "alt" da logo do WordPress na tela de login.
 * Autor: Lyon.dev_
 *
 * @return string Nome do site.
 */
function ldev_custom_login_logo_alt() {
  return get_bloginfo('name');
}
add_filter('login_headertext', 'ldev_custom_login_logo_alt');

/**
 * Altera o texto do rodapé no painel do Administrador.
 * Autor: Lyon.dev_
 *
 * @return string Nome do Desenvolvedor + WordPress.
 */
function ldev_footer_admin(){
	echo '<p style="display: flex; align-items: center; gap: 5px;">&copy; ' . date('Y') . ' - ' . get_bloginfo('name') . ' | 
					Criado por
					<a style="display: inline-flex; align-items: center; padding-top: 3px" href="https://lyon.dev/?ref=wp-admin&site='.sanitize_text_field(get_bloginfo('name')).'" target="_blank">
						<img src="https://lyon.dev/img/logo-gray.svg" width="70" alt="Lyon.dev_">
						<span style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0; ">Lyon.dev_</span>
					</a> usando <a href="http://www.wordpress.org">WordPress</a>
				</p>';
}
add_filter('admin_footer_text', 'ldev_footer_admin');

/**
 * Filtros de otimização.
 * Autor: Lyon.dev_
 */
show_admin_bar(false);
add_filter( 'wpseo_debug_markers', '__return_false' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Remove os estilos desnecessários do Gutenberg em determinadas páginas.
 * Autor: Lyon.dev_
 */
function ldev_remove_gtb_styles() {
  // Verifica se não é uma página de post individual
  // Remove os estilos do Gutenberg
  if (!is_single()) {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'classic-theme-styles' );

    // Remove os estilos do WooCommerce
    wp_dequeue_style( 'wc-block-style' );

    // Remove outros estilos globais
    wp_dequeue_style( 'global-styles' );
  }
}
    add_action( 'wp_enqueue_scripts', 'ldev_remove_gtb_styles', 100 );
/**
 * Remove a logo do WP do Painel
 * Autor: Lyon.dev_
 */
function ldev_remove_wp_logo(){
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'ldev_remove_wp_logo', 0);

/**
 * Adiciona o nome do template utilizado ao lado do nome da página na listagem
 * Autor: Lyon.dev_
 */
function ldev_template_admin ( $post_states, $post ) {
  $template = get_page_template_slug($post->ID);
  if ($template && function_exists('get_page_templates')) {
    $templates = get_page_templates(null, 'page');
    $template_name = array_search($template, $templates);
    $post_states['template'] = "Template: $template_name";
  }
  return $post_states;
}
add_filter('display_post_states', 'ldev_template_admin', 10, 2);
