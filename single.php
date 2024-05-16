<?php if(!defined('ABSPATH')) die('Access denied'); 
get_header();
  get_template_part( 'template-parts/singles/post/post', 'banner');
  get_template_part( 'template-parts/singles/post/post', 'content');
  get_template_part('template-parts/pages/blog/blog', 'cta');
  get_template_part( 'template-parts/singles/post/post', 'relateds');
get_footer();
