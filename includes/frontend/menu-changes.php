<?php
add_filter('wp_nav_menu_objects', 'ldev_nav_icon', 10, 2);

function ldev_nav_icon($items, $args)
{
  foreach ($items as &$item) {
    $icon = get_field('icone', $item) ? wp_get_attachment_image(get_field('icone', $item)['id'], 'full', true, ['width' => 18, 'height' => 18]) : '';
    $link_type = get_field('tipo_de_link', $item);
    // change attr link to open in new tab
    switch($link_type){
      case 'popup':
        $item->url = '#popup';
        $item->classes[] = 'popup-orcamento';
        break;
      case 'whatsapp':
        $whatsapp = ldev_phone(get_theme_mod('ldev_company_whatsapp'));
        $item->url = 'https://api.whatsapp.com/send?phone=' . $whatsapp;
        break;
      case 'padrao' :
        $item->url = $item->url;
        break;
      default:
        $item->url = $item->url;
    }

    // Modifica o título para incluir a descrição e o ícone, se existirem
    if ($icon || $item->description) {
      $item->title = "<span class='menu-item-title'>" . $item->title . "</span>" .
      ($item->description ? "<span itemprop='description'>{$item->description}</span>" : '') .
      ($icon ? "<span class='icon'>{$icon}</span>" : '');
    }
  }
  return $items;
}

add_filter('wp_nav_menu_mega_menu_extra_content', 'ldev_mega_menu_items', 10, 3);
function ldev_change_dropdown_megamenu_class($classes, $item, $args){
  if (in_array('dropdown-menu', $classes)) {
    $classes[] = 'col-lg-4';
  }
  return $classes;
}
add_filter('nav_menu_submenu_css_class', 'ldev_change_dropdown_megamenu_class', 10, 3);


add_filter('wp_nav_menu_items', 'ldev_social_media_menu', 10, 2);
function ldev_social_media_menu($items, $args)
{
  $menu = wp_get_nav_menu_object($args->menu);
  if ($args->theme_location == 'menu-principal' || $args->theme_location == 'menu-blog') {
    $mostrar_redes_sociais = get_field('mostrar_redes_sociais', $menu);
    if (!$mostrar_redes_sociais) return $items;
    $redes_sociais = ldev_social_media_links();
    $li = '<li class="nav-item aic flex gap-0-5 ml-3 sm-icons">';
    foreach ($redes_sociais as $social_media) {
      $li .= '<a class="nav-social-media" href="' . $social_media['url'] . '" title="Siga-nos no ' . $social_media['label'] . '">' . $social_media['label'] . '</a>';
    }
    $li .= '</li>';
    $items = $items . $li;
  }
  return $items;
}
