<?php if (!defined('ABSPATH')) die('Access denied');
$logo = ldev_logo_html();
$class = is_paged() ? 'no-banner' : '';
$left_menu = get_theme_mod('ldev_header_left_menu');
$menu_label = get_theme_mod('ldev_header_left_menu_label');
?>
<div class="navbar-fixed-top <?= $class ?>">
  <nav class="px-1 container-fluid navbar menu-topo grid" id="navbar-menu">
    <h2 class="sr-only">Menu de Navegação</h2>
    <?php if($menu_label && $left_menu): ?>
      <?php get_template_part('template-parts/components/menus/header', 'left-menu', ['label' => $menu_label, 'menu' => $left_menu]) ?>
    <?php endif; ?>
    <div class="logo txt-ct">
      <a class="navbar-brand d-block" href="<?= site_url(); ?>" title="<?= get_bloginfo('name') ?>">
        <?= $logo; ?>
      </a>
    </div>
    <div class="menu-primary txt-rg">
      <button class="navbar-toggler inline-flex aic gap-0-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#main-menu" aria-controls="main-menu" aria-label="Toggle navigation">
        Menu <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 12H21" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M3 6H21" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M3 18H21" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="main-menu" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header aic">
          <div class="favicon"><?= ldev_favicon() ?></div>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18" stroke="#191C1F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 6L18 18" stroke="#191C1F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>
        <div class="offcanvas-body">
          <?php
            $menu = 'main-menu';
            wp_nav_menu([
              'theme_location'    => $menu,
              'depth'             => 2,
              'container'         => 'div',
              'container_class'   => 'main-menu',
              'menu_class'        => 'nav grid my-3',
              'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
              'walker'            => new WP_Bootstrap_Navwalker(),
            ]);
          ?>
          <?php get_template_part('template-parts/components/buttons/button', 'social-media', ['size' => 1.5]) ?>
        </div>
      </div>
    </div>
  </nav>
</div>