<?php if(!defined('ABSPATH')) die('Access denied');

  $term = get_queried_object();
  $term_name = isset($term->name) ? $term->name : '';

  // Obtendo todos os termos da taxonomia 'boat_category'
  $categories = ldev_get_sorted_boat_categories();

  $tax = is_tax('boat_category') ? [
    'tax_query' => [[
      'taxonomy' => $term->taxonomy,
      'field' => 'slug',
      'terms' => $term->slug 
    ]]
  ] : [];

  // Definir argumentos para WP_Query
  $args = [
    'post_type' => 'boat',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
  ];
  
  if($tax) {
    $args = array_merge($args, $tax);
  }

  // Executar a consulta WP_Query
  $query = new WP_Query($args);
  
  if($query->have_posts()) :
?>
  <section class="container py-6 boat-listing">
    <?php if ($categories && is_array($categories)) : ?>
      <div class="row">
        <div class="filters flex jcc txt-ct mb-5 gap-1 aic w-100">
          <button class="btn-unstyled active t-gray t-up" data-filter="all">All</button>
          <?php foreach ($categories as $category) : ?>
            <button class="btn-unstyled t-gray t-up" data-filter="<?= esc_attr($category->slug); ?>"><?= esc_html($category->name); ?></button>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
    <div class="row row-cols-2 row-cols-md-4 gap-y-2" id="boats-container">
      <?php
        while($query->have_posts()) : $query->the_post(); 
          $terms = get_the_terms(get_the_ID(), 'boat_category');
          $term_slugs = [];
          if ($terms && !is_wp_error($terms)) :
            foreach ($terms as $term) : $term_slugs[] = $term->slug; endforeach;
          endif;
          $term_name = !empty(get_the_terms(get_the_ID(), 'boat_category')) ? get_the_terms(get_the_ID(), 'boat_category')[0]->name : '';    
          $boats_data = [
            'id'        => get_the_ID(),
            'title'     => get_the_title(),
            'thumbnail' => get_the_post_thumbnail_url(),
            'excerpt'   => get_the_excerpt(),
            'terms'     => $term_slugs,
            'term_name' => $term_name,
          ];
          get_template_part('template-parts/components/cards/boat', 'standard', ['boat' => $boats_data]);
          if($query->current_post + 1 === $query->post_count && $query->max_num_pages === get_query_var('paged')) {
            get_template_part('template-parts/components/cards/boat', 'cta');
          }
        endwhile;
      ?>
    </div>
  </section>
<?php endif; ?>

<?php
  // Reset post data
  wp_reset_postdata();
?>