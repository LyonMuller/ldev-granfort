<?php if(!defined('ABSPATH')) die('Access denied'); 
get_header();
  get_template_part('template-parts/pages/front-page/front', 'boats');
  get_template_part('template-parts/pages/front-page/front', 'why-granfort');
  get_template_part('template-parts/pages/front-page/front', 'technology');
  get_template_part('template-parts/pages/front-page/front', 'social-media');
  get_template_part('template-parts/pages/front-page/front', 'cta');
  get_template_part('template-parts/pages/front-page/front', 'dealers');
get_footer();