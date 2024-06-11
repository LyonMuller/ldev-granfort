<?php 

function ldev_admin_area_scripts() {
  // check if is menu amdin area
  $screen = get_current_screen();
  if ($screen->base == 'nav-menus') {
    wp_enqueue_script('jquery');
    wp_enqueue_script('ldev-admin-menu', ldev_assets_url('js/admin-area-menu.js'), ['jquery'], ldev_ver(ldev_assets_url('js/admin-area-menu.js')), true);
    wp_enqueue_style('ldev-admin-menu', ldev_assets_url('css/admin-area.css'), [], ldev_ver(ldev_assets_url('css/admin-area.css')));
    }
}

add_action('admin_enqueue_scripts', 'ldev_admin_area_scripts');
