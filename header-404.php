<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <?php
    get_template_part('template-parts/header/head');
    wp_head();
  ?>
</head>
<body <?php body_class();?>>
  <?php wp_body_open() ?>
  <header>
    <?php get_template_part( 'template-parts/header/section', 'menu'); ?>
    <div class="secao-banner__404 py-6 bg-light">
      <div class="container">
        <div class="row jcc aic" style="min-height: 65vh;">
          <div class="col-lg-10 txt-ct">
            <h1 class="fwb" style="--bg: url(<?= get_theme_mod('ldev_404_background') ?>)">404</h1>
            <h2 class="h5 t-primary mt-4">Não encontramos o que você estava buscando.</h2>
            <p class="ff-heading t-primary">Pedimos desculpa pelo transtorno.</p>
            <div class="flex aic gap-1 mt-4 jcc">
              <a href="<?= bloginfo('url'); ?>" title="Homepage" class="btn-primary">Voltar para a Home</a>
              <a href="<?= get_permalink( ldev_get_page_by_template('page-templates/contato.php')); ?>" title="Homepage" class="btn-outline-primary">Entre em Contato</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>