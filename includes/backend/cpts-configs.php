<?php
add_filter( 'manage_unidade_posts_columns', 'ldev_unidade_listing_column' );
function ldev_unidade_listing_column( $columns ) {
  var_dump($columns);
  $columns = [
    'cb' => $columns['cb'],
    'title' => 'Título',
    'tipo_unidade' => __( 'Tipo de Unidade' ),
  ];
  return $columns;
}
add_action( 'manage_unidade_posts_custom_column', 'ldev_unidade_listing_custom_column', 10, 2);
function ldev_unidade_listing_custom_column( $column, $post_id ) {
  // Image column
  if ( 'tipo_unidade' === $column ) {
    $headquarter = get_theme_mod('ldev_company_headquarters');
    echo "<p style='font-size: 1rem'>".($headquarter === $post_id ? '<b style="color: tomato">Matriz</b>' : 'Filial'). "</p>";
  }
}