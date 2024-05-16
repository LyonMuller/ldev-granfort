<?php if (!defined('ABSPATH')) die('Access denied');
$logo = ldev_logo_html();
$class = is_paged() ? 'no-banner' : '';
?>
<div class="navbar-fixed-top <?= $class ?>">
  <nav class="px-1 container-fluid navbar navbar-expand-lg menu-topo" id="navbar-menu">
    <h2 class="sr-only">Menu de Navegação</h2>
    <div class="menu-header flex aic jcb w-100 ps-rel">
      <div class="col-auto">
        <a class="navbar-brand d-block" href="<?= site_url(); ?>" title="<?= get_bloginfo('name') ?>">
          <?= $logo; ?>
        </a>
      </div>
      <div class="col-auto menu flex aic jce collapse navbar-collapse" id="menu-cont">
        <?php
          $menu = 'menu-principal';
          wp_nav_menu([
            'theme_location'    => $menu,
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'menu-principal',
            'container_id'      => 'menu-principal',
            'menu_class'        => 'nav aic',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
          ]);
        ?>
        <div class="d-mb-show">
          <?php get_template_part('template-parts/footer/info', 'cta'); ?>
        </div>
      </div>
      <button class="col-auto navbar-toggler menu-mobile" type="button" data-toggle="collapse" data-target="#menu-cont" aria-controls="menu-cont" aria-expanded="false" aria-label="Abrir Menu">
        <i class="fal fa-bars"></i>
      </button>
    </div>
  </nav>
</div>