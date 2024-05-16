<?php
/**
 * Registrando Sidebars
 */
if (function_exists('register_sidebar')) {
  register_sidebar([
    'name'          => 'Blog',
    'id'            => 'sidebar-blog',
    'description'   => 'Blog',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="h5 mb-3">',
    'after_title'   => '</h2>'
  ]);
  register_sidebar([
    'name'          => 'Footer Menu',
    'id'            => 'footer-menu',
    'description'   => 'Menu do Rodapé',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2 class="h4 fwl mb-4 t-wh">',
    'after_title'   => '</h2>'
  ]);
  register_sidebar([
    'name'          => 'Footer Menu 2',
    'id'            => 'footer-menu-2',
    'description'   => 'Menu do Rodapé',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2 class="h4 fwl mb-4 t-wh">',
    'after_title'   => '</h2>'
  ]);
}