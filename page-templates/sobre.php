<?php if(!defined('ABSPATH')) die('Access denied'); 
/**
  * Template name: Sobre
  */
get_header();
  get_template_part('template-parts/pages/sobre/sobre', 'descricao');
  get_template_part('template-parts/pages/sobre/sobre', 'descricao-2');
  get_template_part('template-parts/pages/sobre/sobre', 'depoimentos');
  get_template_part('template-parts/pages/sobre/sobre', 'timeline');
  get_template_part('template-parts/pages/sobre/sobre', 'desenvolvimento');
  get_template_part('template-parts/pages/sobre/sobre', 'trabalhe-conosco');
  get_template_part('template-parts/pages/front-page/front', 'empresas');
get_footer();