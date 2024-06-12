<?php if(!defined('ABSPATH')) die('Access denied'); 
get_header();
// detect the current page and load the respective template part
if(is_post_type_archive('boat') || is_tax('boat_category')):
  get_template_part('template-parts/taxonomies/boats/boat', 'listing');
  get_template_part('template-parts/taxonomies/boats/boat', 'technology');
  get_template_part('template-parts/taxonomies/boats/boat', 'cta');
else:
  if(!is_search()) get_template_part('template-parts/pages/blog/blog', 'header');
  get_template_part('template-parts/pages/blog/blog', 'listagem');
endif;
get_footer();
