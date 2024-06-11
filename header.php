<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-bs-theme="light">
  <?php get_template_part('template-parts/header/head'); ?>
  <body <?php body_class();?>>
    <a class="skip-link screen-reader-text" title="Pular para o conteúdo" href="#main-content">Pular para o conteúdo</a>
    <?php wp_body_open() ?>
    <header id="main-content">
      <?php
        get_template_part( 'template-parts/header/section', 'menu');

        if(is_front_page())
          get_template_part( 'template-parts/header/banner', 'front-page');

        elseif(is_post_type_archive('boat') || is_tax('category_boat'))
          get_template_part( 'template-parts/header/banner', 'archive-boat');

        elseif(is_page_template('page-templates/about.php'))
          get_template_part( 'template-parts/header/banner', 'about');

        elseif(is_page_template('page-templates/contact.php'))
          get_template_part( 'template-parts/header/banner', 'contact');

        elseif(is_page_template('page-templates/find-a-dealer.php'))
          get_template_part( 'template-parts/header/banner', 'find-a-dealer');

        elseif(is_singular('boat'))
          get_template_part( 'template-parts/header/banner', 'single-boat');

        elseif(!is_singular('post') && !is_paged())
          get_template_part( 'template-parts/header/banner', 'standard');
        
      ?>
    </header>
    <main>