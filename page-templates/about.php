<?php if(!defined('ABSPATH')) die('Access denied'); 
/**
  * Template name: About
  */
get_header();
  get_template_part('template-parts/pages/about/about', 'description');
  get_template_part('template-parts/pages/about/about', 'mansonry');
  get_template_part('template-parts/pages/about/about', 'timeline');
  get_template_part('template-parts/pages/about/about', 'vision');
  get_template_part('template-parts/pages/about/about', 'map');
  get_template_part('template-parts/pages/about/about', 'cta');
  get_template_part('template-parts/pages/about/about', 'cta-2');
get_footer();