<?php if(!defined('ABSPATH')) die('Access denied'); 
/**
  * Template name: Become a Dealer
  */
get_header();
  get_template_part('template-parts/pages/become-a-dealer/dealer', 'description');
  get_template_part('template-parts/pages/become-a-dealer/dealer', 'why');
  get_template_part('template-parts/pages/become-a-dealer/dealer', 'listing');
  get_template_part('template-parts/pages/become-a-dealer/dealer', 'form');
get_footer();