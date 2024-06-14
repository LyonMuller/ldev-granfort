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
    <div class="secao-banner__404 py-6 bg-light ps-rel" style="--bg: url(<?= get_theme_mod('ldev_404_background') ?>)">
      <div class="container">
        <div class="row jcc aic ps-rel z1" style="min-height: 65vh;">
          <div class="col-lg-10 txt-ct">
            <h1 class="h1 t-wh fwl">404</h1>
            <h2 class="h5 t-wh mt-4">We couldn't found what you're searching.</h2>
            <p class="t-wh mt-4">We apologize for the inconvenience</p>
            <div class="flex aic gap-1 mt-4 jcc flex-wrap">
              <a href="<?= bloginfo('url'); ?>" title="Homepage" class="btn-white">Back to Home</a>
              <a href="<?= get_permalink( ldev_get_page_by_template('page-templates/contato.php')); ?>" title="Homepage" class="btn-outline white">Get in Touch</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>