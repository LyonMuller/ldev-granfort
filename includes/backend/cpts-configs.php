<?php
// Adiciona a coluna de imagem destacada na listagem de posts no WP Admin
function add_thumbnail_column($columns) {
  $new_columns = array();
  foreach ($columns as $key => $value) {
      if ($key == 'title') {
          $new_columns['thumbnail'] = __('Thumbnail', 'textdomain');
      }
      $new_columns[$key] = $value;
  }
  return $new_columns;
}
add_filter('manage_posts_columns', 'add_thumbnail_column');

// Preenche a coluna de imagem destacada com a imagem do post
function show_thumbnail_column($column, $post_id) {
  if ($column === 'thumbnail') {
      if (has_post_thumbnail($post_id)) {
          echo get_the_post_thumbnail($post_id, [80, 80]);
      } else {
          echo __('No Thumbnail', 'textdomain');
      }
  }
}
add_action('manage_posts_custom_column', 'show_thumbnail_column', 10, 2);

// Ajusta a largura da coluna de imagem destacada
function thumbnail_column_style() {
  echo '<style>.column-thumbnail { width: 80px; img {border-radius: 5px; object-fit: cover} }</style>';
}
add_action('admin_head', 'thumbnail_column_style');

