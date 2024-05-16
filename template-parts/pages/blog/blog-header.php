<?php 
  $categorias = get_categories();
?>
<section class="container pt-6 blog-header">
  <div class="row">
    <div class="col-lg-9">
      <?php if(!is_paged() && is_home()): ?>
        <h2 class="mb-0 h2 titulo-span-secondary fwl"><b>Todos</b> os posts</h2>
      <?php else : ?>
        <h2 class="mb-0 h2 titulo-span-secondary fwl">
          <b>Página</b> <?= get_query_var('paged') ? get_query_var('paged') : 1 ?> de <?= $wp_query->max_num_pages ?>  
        </h2>
      <?php endif; ?>
    </div>
    <div class="col-lg-3">
      <?php get_template_part('template-parts/components/blog/search', 'form'); ?>
    </div>
    <div class="categorias-produtos col-lg-12 mt-4">
      <nav>
        <ul class="nav nav-pills border-bottom light-100 mb-4 ff-headings t-up aic">
          <li class="nav-item mr-3 t-gray flex aic gap-0-5">
            <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 1.00006H1L6.6 7.62206V12.2001L9.4 13.6001V7.62206L15 1.00006Z" stroke="#9DA0A1" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <small>Filtrar por:</small>
          </li>
          <li class="nav-item <?= is_home() ? 'active' : '' ?>">
            <a class="nav-link" href="<?= get_permalink(get_option('page_for_posts')) ?>">Todos</a>
          </li>
          <?php foreach ($categorias as $categoria) :
            $current = is_category($categoria->term_id) ? 'active' : '';  
          ?>
            <li class="nav-item <?= $current ?>">
              <a class="nav-link" href="<?= esc_url(get_term_link($categoria))  ?>"><?= esc_html($categoria->name) ?></a>
            </li>
          <?php endforeach ?>
        </ul>
      </nav>
    </div>
  </div>
</section>