<?php
  $term = get_queried_object();
  $term_name = $term->name;

  $tax = is_tax('categoria_produto') ? [
    'tax_query' => [[
      'taxonomy' => $term->taxonomy,
      'field' => 'slug',
      'terms' => $term->slug 
    ]]
  ] : '';

  $args = [
    'post_type' => 'produto',
    'posts_per_page' => 12,
    'paged' => get_query_var('paged'),
  ];
  
  if($tax) {
    $args = array_merge($args, $tax);
  }

  $query = new WP_Query($args);
  
  if($query->have_posts()) :
?>
  <section class="container pb-6 listagem-produtos">
    <div class="row row-cols-2 row-cols-md-3">
      <?php
        while($query->have_posts()) : $query->the_post(); 
          get_template_part('template-parts/components/produto/produto');
          if($query->current_post + 1 === $query->post_count && $query->max_num_pages === get_query_var('paged')) {
            get_template_part('template-parts/components/produto/cta');
          }
        endwhile;
      ?>
    </div>
    <div class="row">
      <div class="col-12">
        <?= the_posts_pagination([
        'prev_text' => 'Anterior',
        'next_text' => 'Próximo',
        'screen_reader_text' => 'Navegação',
        'aria_label' => 'Posts',
        'class' => 'blog-pagination',
        'total' => $wp_query->max_num_pages,
        'mid_size' => 3,
      ]); ?>
      </div>
    </div>
  </section>
<?php endif; ?>