<?php if (!defined('ABSPATH')) die('Access denied'); ?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#001F49">
  <title><?= ldev_title() ?></title>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <!-- CSS Crítico -->
  <?php include_once('critical-css.php') ?>
  <script>
    document.documentElement.classList.add('js')
  </script>
  <?php wp_head(); ?>
</head>