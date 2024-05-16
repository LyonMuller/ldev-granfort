<?php if(!defined('ABSPATH')) die('Access denied'); 
get_header();
// detect the current page and load the respective template part
if(is_post_type_archive('produto') || is_tax('categoria_produto')):
  get_template_part('template-parts/taxonomies/produtos/produtos', 'header');
  get_template_part('template-parts/taxonomies/produtos/produtos', 'listagem');
  get_template_part('template-parts/taxonomies/produtos/produtos', 'cta');
else:
  if(!is_search()) get_template_part('template-parts/pages/blog/blog', 'header');
  get_template_part('template-parts/pages/blog/blog', 'listagem');
endif;
get_footer();
