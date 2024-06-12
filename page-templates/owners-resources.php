<?php if(!defined('ABSPATH')) die('Access denied'); 
/**
  * Template name: Owners Resources
  */
get_header();
  get_template_part('template-parts/pages/owners-resources/owners', 'description');
  get_template_part('template-parts/pages/owners-resources/owners', 'resources');
  get_template_part('template-parts/pages/owners-resources/owners', 'cta');
get_footer();