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

        elseif(is_post_type_archive('produto') || is_tax('categoria_produto'))
          get_template_part( 'template-parts/header/banner', 'produtos');

        elseif(is_home() && !is_paged())
          get_template_part( 'template-parts/header/banner', 'blog');
        
        elseif(is_archive() && is_paged())
        get_template_part( 'template-parts/header/banner', 'archive');
      
        elseif(is_search())
          get_template_part( 'template-parts/header/banner', 'search');

        elseif(is_page_template('page-templates/sobre.php'))
          get_template_part( 'template-parts/header/banner', 'sobre');

        elseif(is_page_template('page-templates/contato.php'))
          get_template_part( 'template-parts/header/banner', 'contato');

        elseif(is_singular('produto'))
          get_template_part( 'template-parts/header/banner', 'single-produto');

        elseif(!is_singular('post') && !is_paged())
          get_template_part( 'template-parts/header/banner', 'standard');
        
      ?>
    </header>
    <main>