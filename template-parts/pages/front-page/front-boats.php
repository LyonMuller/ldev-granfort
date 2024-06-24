<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('boats_section')) : while(have_rows('boats_section')) : the_row();
  $title      = get_sub_field('title');
  $categories = get_sub_field('categories');

  $args = [
    'post_type' => 'boat',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
  ];
  $boats = new WP_Query($args);

  $boats_data = [];

  if ($boats->have_posts()) : while ($boats->have_posts()) : $boats->the_post();
    $terms = get_the_terms(get_the_ID(), 'boat_category');
    $term_slugs = [];
    if ($terms && !is_wp_error($terms)) :
      foreach ($terms as $term) : $term_slugs[] = $term->slug; endforeach;
    endif;
    $term_name = !empty(get_the_terms(get_the_ID(), 'boat_category')) ? get_the_terms(get_the_ID(), 'boat_category')[0]->name : '';
    $boats_data[] = [
      'id'        => get_the_ID(),
      'title'     => get_the_title(),
      'thumbnail' => get_the_post_thumbnail_url(),
      'excerpt'   => get_the_excerpt(),
      'terms'     => $term_slugs,
      'term_name' => $term_name,
    ];
  endwhile; endif;

  wp_reset_postdata();

  if($title && !empty($categories)) :
?>
<div class="front-boats ps-rel ovf-h py-6">
  <div class="container">
    <div class="row jcc ais gap-y-2 wow animate__fadeIn">
      <div class="col-md-8 txt-ct ovf-h">
        <h2 class="title mb-4 fwn t-up"><?= $title ?></h2>
      </div>
      <?php if ($categories) : ?>
        <div class="filters flex flex-wrap jcc txt-ct mb-4 gap-1 aic">
        <button class="btn-unstyled active t-gray t-up" data-filter="all">All</button>
          <?php foreach ($categories as $category) : ?>
            <button class="btn-unstyled t-gray t-up" data-filter="<?php echo esc_attr($category->slug); ?>"><?php echo esc_html($category->name); ?></button>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <div class="col-lg-12">
        <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4" id="boats-container">
          <?php foreach ($boats_data as $boat) : get_template_part('template-parts/components/cards/boat', 'standard', ['boat' => $boat]); endforeach; ?>
        </div>
      </div>
      <div class="w-100 mt-5 pagination flex jcc">
        <div class="t-body txt-ct flex gap-1 aic">
          <button id="prev-page" aria-label="Previous" class="btn-unstyled">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.25 13.5L6.75 9L11.25 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <span id="page-indicator">1</span>
          <button id="next-page" aria-label="Next" class="btn-unstyled">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.75 13.5L11.25 9L6.75 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>