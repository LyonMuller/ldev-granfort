<?php

// Função para modificar a consulta principal
function ldev_custom_archive_query($query) {
  if (
    $query->is_main_query() &&
    (
      is_post_type_archive('arte') ||
      is_post_type_archive('design') ||
      is_post_type_archive('loja') ||
      is_post_type_archive('fotografia')
    )
  ) $query->set('posts_per_page', -1);
}
add_action('pre_get_posts', 'ldev_custom_archive_query');

