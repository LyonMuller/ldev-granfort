<?php

function ldev_check_plugin($path)
{
  include_once(ABSPATH . 'wp-admin/includes/plugin.php');
  if (is_plugin_active($path)) return true;
  else return false;
}
add_action('admin_init', 'ldev_check_plugin');

/**
 * Retorna o título da página, considerando a página inicial e o plugin Yoast SEO.
 * Autor: Lyon.dev_
 *
 * @return string Título da página.
 */
function ldev_title()
{
  return (is_front_page() && !ldev_check_plugin('wordpress-seo/wp-seo.php') ? bloginfo('name') : wp_title());
}

function ldev_ver($file_path){
  $stylesheet_url = $file_path;
  $stylesheet_file = str_replace(get_site_url(), ABSPATH, $stylesheet_url);
  // check if have archive
  if (!file_exists($stylesheet_file)) return false;
  return filemtime($stylesheet_file);
}

/**
 * Retorna a URL do tema, com a opção de fornecer um caminho relativo.
 * Autor: Lyon Müller
 *
 * @param string|null $path (opcional) Caminho dentro do tema.
 * @return string URL do tema.
 */
function ldev_theme_url($path = null)
{
  return get_stylesheet_directory_uri() . '/' . $path;
}

/**
 * Retorna a URL dos assets do tema, com a opção de fornecer um caminho relativo.
 * Autor: Lyon Müller
 *
 * @param string|null $path (opcional) Caminho dentro dos assets do tema.
 * @return string URL dos assets do tema.
 */
function ldev_assets_url($path = null)
{
  return ldev_theme_url() . 'assets/' . $path;
}

/**
 * Retorna a URL da logo personalizada, ou uma URL padrão caso não haja uma logo definida.
 * Autor: Lyon.dev_
 *
 * @return string URL da logo.
 */
function ldev_logo_url()
{
  $custom_logo_id = get_theme_mod('custom_logo');
  if ($custom_logo_id) {
    $image = wp_get_attachment_image_src($custom_logo_id, 'full');
    return $image[0];
  } else {
    return 'https://lyon.dev/img/logo-gray.svg';
  }
}

/**
 * Retorna o HTML do Botão
 * Autor: Lyon.dev_
 * @param array Array do botão provido pelo ACF
 * @param string Classe do Botão
 * @return string HTML completo do Botão
 */
function ldev_btn($botao, $class = 'btn-primary', $echo = true, ...$args){
  if (!$botao || !is_array($botao)) return;

  $classAttr  = 'class="' . $class . '"';
  $urlAttr    = 'href="' . $botao['url'] . '"';
  $ariaAttr   = 'aria-label="' . $botao['title'] . '"';
  $titleAttr  = 'title="' . $botao['title'] . '"';
  $targetAttr = 'target="' . (isset($botao['target']) ? $botao['target'] : '_self') . '"';
  $args       = implode(' ', $args);
  if($echo) {
    echo "<a $urlAttr $classAttr $titleAttr $ariaAttr $targetAttr $args>" . $botao['title'] . "</a>";
  } else {
    return "<a $urlAttr $classAttr $titleAttr $ariaAttr $targetAttr $args>" . $botao['title'] . "</a>";
  }
}

/**
 * Retorna o HTML do Botão
 * Autor: Lyon.dev_
 * @param array Array do botão provido pelo ACF
 * @param string Classe do Botão
 * @return string HTML completo do Botão
 */
function ldev_btn_customizer($button_type, $botao_info, $class = 'btn-primary', ...$args){
  if (!$botao_info || !is_array($botao_info)) return;

  $text  = isset($botao_info['text']) ? $botao_info['text'] : '';
  $url   = isset($botao_info['url']) ? $botao_info['url'] : '';
  $modal = isset($botao_info['modal']) ? $botao_info['modal'] : '';
  $button_type = $button_type ? $button_type : 'link';

  switch($button_type) :
    case 'nenhum':
      return;
      break;
    case 'link':
      $classAttr  = 'class="contato-link ' . $class . '"';
      $urlAttr    = 'href="' . $url . '"';
      $ariaAttr   = 'aria-label="' . $text . '"';
      $titleAttr  = 'title="' . $text . '"';
      $args       = implode(' ', $args);
      echo "<a $urlAttr $classAttr $titleAttr $ariaAttr $args>$text</a>";
      break;

    case 'whatsapp':
      $classAttr  = 'class="' . $class . ' whatsapp" ';
      $whatsapp = ldev_phone(get_theme_mod('ldev_company_whatsapp'));
      $urlAttr    = 'href="https://api.whatsapp.com/send?phone=55' . $whatsapp . '"';
      $args       = implode(' ', $args);
      echo "<a $urlAttr $classAttr $args target='_blank'>$text</a>";
      break;
    
    case 'popup' :
      $classAttr  = 'class="' . $class . ' popup btn-modal" data-target="#modal-' . $modal . '"';
      $ariaLabel  = 'aria-label="' . $text . '"';
      $args       = implode(' ', $args);
      echo "<a href='#popup' $classAttr $ariaLabel $args>$text</a>";
      break;
    
    case 'contato' :
      $contato_page_link = get_permalink(ldev_get_page_by_template('page-templates/contato.php'));
      $classAttr  = 'class="contato-link ' . $class . '"';
      $args       = implode(' ', $args);
      echo "<a $classAttr $args href='$contato_page_link'>$text</a>";
      break;

    default:
      return;
      break;
  endswitch;
}


/**
 * Retorna a imagem com lazyload
 * Autor: Lyon.dev_
 * @param string ID da imagem
 * @param string Classe da imagem
 * @return string HTML completo da imagem
 */
function ldev_lazy_img($img_id, $class = '', $size = 'full', $dimensions = [], $attr = '')
{
  if (!$img_id) return;
  switch ($size) {
    case 'thumbnail':
      $srcset_size = 'medium';
      break;
    case 'medium':
      $srcset_size = 'large';
      break;
    case 'large':
      $srcset_size = 'full';
      break;
    default:
      $srcset_size = 'full';
      break;
  }

  $image_src    = wp_get_attachment_image_src($img_id, $size, true);
  $image_srcset = wp_get_attachment_image_srcset($img_id, $srcset_size, true);
  $image_sizes  = wp_get_attachment_image_sizes($img_id, $size);
  $image_alt    = get_post_meta($img_id, '_wp_attachment_image_alt', true) ? get_post_meta($img_id, '_wp_attachment_image_alt', true) : get_post($img_id)->post_title;

  // check image extension
  $ext = pathinfo($image_src[0], PATHINFO_EXTENSION);
  
  // Obter as dimensões da imagem
  $image_data = wp_get_attachment_metadata($img_id);
  $img_width  = isset($dimensions['width']) ? $dimensions['width']   : (isset($image_data['sizes'][$size]['width']) ? $image_data['sizes'][$size]['width'] : (isset($image_data['width']) ? $image_data['width'] : ($ext != 'svg' ? 100 : '')));
  $img_height = isset($dimensions['height']) ? $dimensions['height'] : (isset($image_data['sizes'][$size]['height']) ? $image_data['sizes'][$size]['height'] : (isset($image_data['height']) ? $image_data['height'] : ($ext != 'svg' ? 100 : '')));

  $img_src        = "src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR4nGP4z8DAAAAEAQEARwbK3gAAAABJRU5ErkJggg==' data-src='$image_src[0]'";
  $img_srcset     = isset($image_srcset) && $image_srcset ? "data-srcset='$image_srcset'" : '';
  $img_sizes      = isset($image_sizes) && $image_sizes ? "data-sizes='$image_sizes'" : '';
  $img_alt        = "alt='$image_alt'";
  $img_class      = "class='lozad $class'";
  $img_loading    = "loading='lazy'";
  $img_dimensions = "width='$img_width' height='$img_height'";
  
  // var_dump($args);
  $attr_html = '';
  if($attr && is_array($attr)) :
    foreach ( $attr as $name => $value ) {
      $attr_html .= " $name=" . '"' . $value . '"';
    }
  endif;

  // Montar o HTML da imagem
  echo "<img $img_src $img_srcset $img_sizes $img_alt $img_class $img_loading $img_dimensions $attr_html/>";
}


/**
 * Retorna o Iframe do Youtube
 * Autor: Lyon.dev_
 * @param string URL do vídeo
 * @param string URL da imagem de preview
 * @param string Alt da imagem de preview
 * @return string HTML completo do Iframe
 */
function ldev_youtube($url = '', $imagem = '', $botao = '', $alt = null)
{
  if (!$url) return;
  $videoId = '';
  $pattern = '/(?:youtube\.com\/(?:[^\/]+\/[^\/]+\/|(?:v|e(?:mbed)?)\/|[^\/]+\?v=)|youtu\.be\/)([^"&?\/ ]{11})/';

  $imagem = is_array($imagem) && isset($imagem['url']) ? $imagem['url'] : wp_get_attachment_image_src($imagem, 'full')[0];

  if (preg_match($pattern, $url, $matches)) $videoId = $matches[1];

  if (!empty($videoId)) :
?>
    <div class="aspect-16-9 ps-rel youtube-iframe ovf-h flex jcc aic" id="yt-<?= $videoId ?>">
      <div class="youtube-autoplay w-100 h-100">
        <div class="items">
          <img class='img-btn aspect-16-9 border-radius-sm' src='<?= ($imagem ? $imagem : 'https://i3.ytimg.com/vi/' . $videoId . '/maxresdefault.jpg') ?>' alt='<?= $alt ?>'>
          <?php if ($botao): ?><p><?= $botao ?></p><?php endif; ?>
            <svg viewbox="0 0 130 130" width="90" height="90" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M130 65c0-35.898-29.101-65-65-65C29.102 0 0 29.102 0 65c0 35.899 29.102 65 65 65 35.899 0 65-29.101 65-65Z" fill="#3A3AFF"/><path d="M88.227 61.356c2.364 1.397 2.364 4.89 0 6.288L56.318 86.508C53.954 87.906 51 86.158 51 83.364V45.636c0-2.795 2.955-4.542 5.318-3.144l31.91 18.864Z" fill="#fff"/></svg>
        </div>
      </div>
      <script>
        function ldev_playVideo(yt) {
          let iframe = document.createElement('iframe');
          iframe.setAttribute('src', `https://www.youtube.com/embed/<?= $videoId ?>?autoplay=1&rel=0&controls=1&showinfo=0`);
          iframe.setAttribute('frameborder', '0');
          iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
          iframe.setAttribute('allowfullscreen', '');
          iframe.setAttribute('class', 'w-100 aspect-16-9 border-radius-sm ovf-h');
            
          document.querySelector('.items').remove();
          document.querySelector(yt).append(iframe);
        }
        const yt = "#yt-<?= $videoId ?> .youtube-autoplay";


        document.querySelector(yt).addEventListener('click', function() { ldev_playVideo(yt)});

      </script>
    </div>
<?php endif;
}


/**
 * Retorna o Iframe do Youtube com uma Popup
 * Autor: Lyon.dev_
 * @param string URL do vídeo
 * @param string URL da imagem de preview
 * @param string Alt da imagem de preview
 * @return string HTML completo do Iframe
 */
function ldev_youtube_popup($url = '', $post_id = ''){
    if (!$url) return;

    $videoId = '';
    $pattern = '/(?:youtube\.com\/(?:[^\/]+\/[^\/]+\/|(?:v|e(?:mbed)?)\/|[^\/]+\?v=)|youtu\.be\/)([^"&?\/ ]{11})/';

    if (preg_match($pattern, $url, $matches)) $videoId = $matches[1];

    if (!empty($videoId)) :
        $id = 'yt_' . str_replace('-', '', $videoId) . "_$post_id";
        $modal_id = "modal_$id";
?>
  <div class="ps-abs z1 btn-modal" onclick="openModal('<?= $modal_id ?>')">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="80" height="80" viewBox="0 0 105 105"><circle cx="52.5" cy="52.5" r="52.5" fill="#fff"/><circle cx="52.5" cy="52.5" r="44" stroke="url(#a)" stroke-width="2"/><path fill="#49FC7C" d="M66.61 50.166c1.358.725 1.421 2.649.114 3.462L47.15 65.8c-1.307.814-3.005-.094-3.055-1.632l-.756-23.037c-.05-1.54 1.583-2.556 2.941-1.83l20.33 10.864Z"/><defs><linearGradient id="a" x1="61.5" x2="16.125" y1="34.125" y2="67.125" gradientUnits="userSpaceOnUse"><stop stop-color="#49FC7C"/><stop offset="1" stop-color="#49FC7C" stop-opacity="0"/></linearGradient></defs></svg>
  </div>
  <div class="modal" id="<?= $modal_id ?>">
    <div class="modal-content">
      <span class="close" onclick="closeModal('<?= $modal_id ?>')">&times;</span>
      <div class="modal-body"></div>
    </div>
  </div>
  <script>
      let modalCreated<?= $id ?> = false;
      let videoPlayer<?= $id ?>;

      function openModal(modalId) {
          const modal = document.getElementById(modalId);
          if (!modalCreated<?= $id ?>) {
              const iframe = document.createElement('iframe');
              iframe.src = `https://www.youtube.com/embed/<?= $videoId ?>?autoplay=1&rel=0&controls=1&showinfo=0`;
              iframe.frameBorder = '0';
              iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
              iframe.allowFullscreen = true;
              iframe.className = 'w-100 aspect-16-9 border-radius-lg ovf-h';

              modal.querySelector('.modal-body').appendChild(iframe);
              videoPlayer<?= $id ?> = iframe; // Armazena a referência para o player de vídeo
              modalCreated<?= $id ?> = true;
          }

          modal.style.display = 'block';
      }

      function closeModal(modalId) {
          const modal = document.getElementById(modalId);
          modal.style.display = 'none';

          // Pausa o vídeo ao fechar o modal
          if (videoPlayer<?= $id ?> && typeof videoPlayer<?= $id ?>.contentWindow.postMessage === 'function') {
              videoPlayer<?= $id ?>.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
          }
      }
  </script>
<?php endif;
}


/**
 * Define um cookie quando um usuário faz login no WordPress
 * Autor: Lyon.dev_
 *
 * @param string $user_login Login do usuário
 * @param object $user Objeto do usuário
 * @return void
 */

function ldev_set_login_cookie()
{
  $cookie_name = 'ldev_logado';
  $cookie_value = 'logged_in';
  $expiration = time() + (86400 * 30); // Expiração em 30 dias

  setcookie($cookie_name, $cookie_value, $expiration, '/');
}
add_action('wp_login', 'ldev_set_login_cookie', 10, 2);

/**
 * Remove um cookie quando um usuário faz loggout no WordPress
 * Autor: Lyon.dev_
 * @return void
 */

function ldev_remove_login_cookie()
{
  if (isset($_COOKIE['ldev_logado'])) {
    unset($_COOKIE['ldev_logado']);
    setcookie('ldev_logado', null, -1, '/');
  }
}
add_action('wp_logout', 'ldev_remove_login_cookie');


function ldev_get_related_posts_by_category($post_id, $min_posts = 3, $max_posts = 6)
{
  // Obtém a custom post type do post atual
  $cpt_slug = get_post_type($post_id);

  // Obtém as taxonomias associadas à custom post type
  $taxonomies = get_object_taxonomies($cpt_slug);

  // Verifica se há alguma taxonomia associada à CPT
  if (empty($taxonomies)) {
    return []; // Se não houver, retorna um array vazio
  }

  // Obtém as categorias/taxonomias do post atual
  $post_terms = wp_get_post_terms($post_id, $taxonomies[0], ["fields" => "ids"]);

  // Argumentos para a consulta dos posts relacionados
  $args = [
    'post_type' => $cpt_slug,
    'post__not_in' => [$post_id], // Exclui o post atual da consulta
    'posts_per_page' => $max_posts, // Número máximo de posts relacionados a serem exibidos
    'tax_query' => [[
      'taxonomy' => $taxonomies[0],
      'field' => 'term_id',
      'terms' => $post_terms,
    ]],
    'fields' => 'ids',
    'no_found_rows' => true,
  ];

  // Consulta dos posts relacionados
  $related_posts = new WP_Query($args);

  // Verifica se há posts suficientes para retornar
  if ($related_posts->post_count >= $min_posts) {
    // Se houver posts suficientes da mesma categoria/taxonomia, retornar os posts relacionados
    return $related_posts->posts;
  }

  // Caso não haja posts suficientes, redefina a consulta para incluir todos os posts da custom post type
  $args['tax_query'] = [];
  $args['posts_per_page'] = $max_posts;
  $related_posts = new WP_Query($args);

  // Restaure a consulta original para ser usada na exibição dos posts
  wp_reset_postdata();

  return $related_posts->posts;
}

function ldev_logo_root_url() {
  ?>
    <style>
      :root {
        --ld-logo-url: url(<?= ldev_logo_url() ?>)
      }
    </style>
  <?php
}
add_filter('wp_head', 'ldev_logo_root_url');

function ldev_logo_html($logo = '')
{ 
  $logo = isset($logo) && $logo != '' ? $logo : ldev_logo_url();
  $ext  = pathinfo($logo, PATHINFO_EXTENSION);
  $ssl  = ["ssl" => ["verify_peer" => false, "verify_peer_name" => false]];
  if ($logo && $ext == 'svg') {
    // Para SVG, não precisamos obter a largura e a altura, pois o SVG é um arquivo vetorial
    // Portanto, apenas defina o conteúdo do SVG no elemento
    $logo_contents = file_get_contents($logo, false, stream_context_create($ssl));
    return $logo_contents;
  } else {
    // Para outras imagens (não SVG), obtenha as informações de tamanho usando wp_get_attachment_image_src()
    $attachment_id = attachment_url_to_postid($logo);
    $image_data = wp_get_attachment_image_src($attachment_id, 'full'); // 'full' é o tamanho da imagem original

    if ($image_data && is_array($image_data)) {
      $width  = isset($image_data[1]) ? $image_data[1] : 100; // Largura da imagem
      $height = isset($image_data[2]) ? $image_data[2] : 100; // Altura da imagem
    } 
    return '<img data-no-lazy="1" width="' . $width . '" height="' . $height . '" src="' . $logo . '" alt="' . get_bloginfo('name') . ' - ' . get_bloginfo('description') . '"/>';
  }
}


function ldev_get_limited_excerpt($excerpt)
{
  if (empty($excerpt)) {
    // Se estiver vazio, pegue o conteúdo do post
    $content = get_the_content();

    // Divida o conteúdo em parágrafos
    $paragraphs = preg_split('/\n|\r\n?/', $content);

    // Verifique se há parágrafos e pegue o primeiro
    if (!empty($paragraphs)) $excerpt = $paragraphs[0];
  } else {
    // Se o campo do resumo estiver preenchido, pegue até a primeira frase do parágrafo
    $sentences = preg_split('/(?<=[.!?])\s+/', $excerpt);
    // verifica se a frase passa de 120 caracteres e corta se necessário
    if (strlen($sentences[0]) > 120) $excerpt = substr($sentences[0], 0, 120) . '...';
    else $excerpt = $sentences[0];
  }
  return $excerpt;
}

add_filter('get_the_excerpt', 'ldev_get_limited_excerpt');

function ldev_get_page_by_template($page_template)
{
  if (!$page_template) return false;
  $args = [
    'post_type'      => 'page',
    'fields'          => 'ids',
    'nopaging'       => true,
    'meta_key'       => '_wp_page_template',
    'no_found_rows'  => true,
    'posts_per_page' => 1,
    'meta_value'     => $page_template
  ];
  $posts = get_posts($args);
  return !empty($posts) ? $posts[0] : null;
}

function ldev_filter_search_posts($query)
{
  if ($query->is_search) $query->set('post_type', 'post');
  return $query;
}
add_filter('pre_get_posts', 'ldev_filter_search_posts');

function ldev_remove_first_post($query){
  if (is_home() && $query->is_main_query() && !is_paged()) $query->set('offset', 1);
}
add_action('pre_get_posts', 'ldev_remove_first_post');


function ldev_breadcrumbs()
{
  if (function_exists('yoast_breadcrumb')) return yoast_breadcrumb('<div id="ldev-breadcrumbs">', '</div>');
  else return;
}

// add class into body when have some conditions
function ldev_body_class($classes)
{
  // check is home page and not paged
  if (is_singular('produto')) :
    $classes[] = 'wt-banner';
  elseif(
    (is_home() || is_archive() || is_search() || is_single() || is_page_template('page-templates/contato.php') || is_page() || is_404()) && 
    !(is_front_page() || is_page_template('page-templates/quem-somos.php'))
  ) :
    $classes[] = 'w-banner-spacing';
  endif;
  return $classes;
}
add_filter('body_class', 'ldev_body_class');


function ldev_social_media_links(){
  $social_networks = [
    'instagram' => 'Instagram',
    'youtube'   => 'YouTube',
    'facebook'  => 'Facebook',
    'linkedin'  => 'LinkedIn',
  ];
  $social_media_links = [];
  foreach ($social_networks as $network => $label) {
    if(!get_theme_mod('ldev_company_social_'.$network)) continue;
    $social_media_links[] = ['url' => get_theme_mod('ldev_company_social_'.$network), 'label' => $label];
  }
  if(empty($social_media_links)) return;
  return $social_media_links;
}

function ldev_form($formulario) {
  if(!$formulario) return 'Nenhum Formulário Selecionado';
  echo do_shortcode("[contact-form-7 id='$formulario->ID' title='$formulario->title']"); 
}

function ldev_form_wp($formulario) {
  if(!$formulario) return 'Nenhum Formulário Selecionado';
  // check if is a object
  if(is_object($formulario)) $formulario = $formulario->ID;
  echo do_shortcode("[wpforms id='$formulario']"); 
}


function ldev_phone($phone) {
  if(!$phone) return;
  return preg_replace('/[^0-9]/', '', $phone);
}

/**
 * Verifica se existe algum valor não vazio em um array multidimensional.
 * 
 * Essa função percorre todos os níveis de um array multidimensional e verifica se existe
 * pelo menos um valor que não seja nulo ou uma string vazia. A função utiliza a abordagem recursiva
 * para garantir que todos os níveis do array sejam verificados.
 * 
 * @param array $array O array que será verificado.
 * @return bool Retorna false se todos os valores forem vazios ou null, e true se pelo menos
 * um valor não vazio for encontrado.
 */
function ldev_check_empty($array) {
  $valorVazio = true; // Assume inicialmente que todos os valores estão vazios

  // Função interna para aplicar a cada elemento do array
  // Essa função anônima é usada para verificar cada elemento do array.
  // Se um valor não vazio é encontrado, a variável $valorVazio é alterada para false.
  $verificaValor = function($item, $chave) use (&$valorVazio) {
      // Verifica se o valor não é uma string vazia e não é null
      if ($item !== '' && $item !== null) {
          $valorVazio = false; // Encontra um valor não vazio e atualiza a variável de controle
      }
  };

  // Aplica a função a cada elemento do array de forma recursiva
  // Utiliza array_walk_recursive para aplicar $verificaValor em cada elemento do array,
  // independentemente da profundidade do array.
  array_walk_recursive($array, $verificaValor);

  // Retorna false se encontrar algum valor não vazio, true caso contrário
  // O resultado final indica se todos os valores são vazios (true) ou se existe pelo menos
  // um valor não vazio (false).
  return !$valorVazio;
}

function ldev_favicon() {
  return ldev_logo_html(ldev_assets_url('img/svg/favicon.svg'));

}

function ldev_next_section(){
  return '
    <a href="#next-section" class="ps-abs scroll-mouse d-inline-flex aic t-wh wow animate__fadeInUp gap-1" data-wow-delay="2s">
      <svg class="mr-1" width="14" height="22" viewBox="0 0 14 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.0015 16C4.05553 16 1.64453 13.589 1.64453 10.643V6.357C1.64453 3.411 4.05553 1 7.0015 1C9.9475 1 12.3585 3.411 12.3585 6.357V10.643C12.3585 13.589 9.9475 16 7.0015 16Z" stroke="#3A3AFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 19L7 21L10 19" stroke="#3A3AFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 5.28516V7.42816" stroke="#3A3AFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Continue navegando
    </a>
  ';
}

function ldev_share_posts() {
  $social_media = [
    'facebook' => [
      'url' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(get_the_permalink()),
      'title' => 'Compartilhar no Facebook',
    ],
    'linkedin' => [
      'url' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink() . '&title=' . get_the_title() . '&source=' . get_bloginfo('name'),
      'title' => 'Compartilhar no LinkedIn',
    ],
    'twitter' => [
      'url' => 'https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . get_the_title(),
      'title' => 'Compartilhar no Twitter',
    ],
    'whatsapp' => [
      'url' => 'https://api.whatsapp.com/send?text=' . get_the_title() . ' - ' . get_the_permalink(),
      'title' => 'Compartilhar no WhatsApp',
    ]
  ];
  return $social_media;
}
