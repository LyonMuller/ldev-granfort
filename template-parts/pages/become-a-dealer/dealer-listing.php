<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('listing_section')) : while(have_rows('listing_section')) : the_row();
  $title      = get_sub_field('title');
  $text       = get_sub_field('text');
  $categories = get_terms([
    'taxonomy' => 'boat_category',
    'hide_empty' => true,
  ]);

  $args = [
    'post_type' => 'boat',
    'posts_per_page' => -1,
  ];
  
  $boats = new WP_Query($args);
  wp_reset_postdata();

  if(($title || $text) && !empty($categories) && $boats->have_posts()) :
?>
<div class="boat-listing ps-rel ovf-h py-6">
  <div class="container">
    <div class="row jcc ais gap-y-2 wow animate__fadeIn">
      <?php if($title || $text): ?>
        <div class="col-md-8 txt-ct ovf-h">
          <?php if($title): ?>
            <h2 class="title mb-4 fwn t-up"><?= $title ?></h2>
          <?php endif; if($text) : ?>
            <div class="t-gray"><?= $text ?></div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <?php if ($categories) : ?>
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
          while($boats->have_posts()) : $boats->the_post(); 
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
          endwhile;
          get_template_part('template-parts/components/cards/boat', 'cta');
        ?>
      </div>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>