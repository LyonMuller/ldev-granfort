<?php
// Adiciona a coluna de imagem destacada na listagem de posts no WP Admin
function add_thumbnail_column($columns) {
  $new_columns = array();
  foreach ($columns as $key => $value) {
    if ($key == 'title') {
      $new_columns['thumbnail'] = __('Thumbnail', THEME_TEXTDOMAIN);
    }
    if($key == 'date'){
      $new_columns['excerpt_column'] = __('Excerpt', THEME_TEXTDOMAIN);
      $new_columns['category'] = __('Category', THEME_TEXTDOMAIN);
    }
    $new_columns[$key] = $value;
  }
  return $new_columns;
}
add_filter('manage_boat_posts_columns', 'add_thumbnail_column');

// Preenche a coluna de imagem destacada com a imagem do post
function show_thumbnail_column($column, $post_id) {
  if ($column === 'thumbnail') {
    if (has_post_thumbnail($post_id)) echo get_the_post_thumbnail($post_id, [80, 80]);
    else echo '<p style="color: tomato">'.__('No Thumbnail', 'textdomain').'</p>';
  }
  if ($column === 'excerpt_column') {
    $excerpt = get_the_excerpt();
    if(!empty($excerpt)) echo $excerpt;
    else echo '<p style="color: tomato">'.__('No Excerpt', THEME_TEXTDOMAIN).'</p>';
  }
  if($column === 'category') {
    $terms = get_the_terms($post_id, 'boat_category');
    if ($terms && !is_wp_error($terms)) {
      $term_name = [];
      foreach ($terms as $term) {
        $term_name[] = $term->name;
      }
      $terms = implode(', ', $term_name);
      echo "<p>$terms</p>";
    }
    else {
      echo '<p style="color: tomato">'.__('No Category', THEME_TEXTDOMAIN).'</p>';
    }
  }
}
add_action('manage_boat_posts_custom_column', 'show_thumbnail_column', 10, 2);

// Ajusta a largura da coluna de imagem destacada
function thumbnail_column_style() {
  echo '<style>.column-thumbnail { width: 80px; img {border-radius: 5px; object-fit: cover} }</style>';
}
add_action('admin_head', 'thumbnail_column_style');

