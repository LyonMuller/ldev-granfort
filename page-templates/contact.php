<?php if(!defined('ABSPATH')) die('Access denied'); 
/**
  * Template name: Contact
  */

get_header(); 
  get_template_part('template-parts/pages/contact/contact', 'form');
  get_template_part('template-parts/pages/contact/contact', 'customer-service');
get_footer();