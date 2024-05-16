<?php if(!defined('ABSPATH')) die('Access denied'); 
get_header();
  if(!is_archive()) {
    get_template_part('template-parts/pages/blog/blog', 'header');
    get_template_part('template-parts/pages/blog/blog', 'listagem');
  }
get_footer();