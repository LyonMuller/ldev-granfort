<?php 
  $categorias = get_terms([
    'taxonomy' => 'categoria_produto',
    'hide_empty' => false,
  ]);
  $archive_link = get_post_type_archive_link('produto');
?>
<section class="container pt-6 pb-4 categorias-produtos">
  <div class="row aic">
    <div class="col">
    <?php if (!is_wp_error($categorias) && !empty($categorias)) : ?>
      <nav>
        <ul class="nav nav-pills border-bottom light-100 mb-4 ff-headings t-up jcb">
          <li class="nav-item <?= is_post_type_archive('produto') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= $archive_link ?>">Todos</a>
          </li>
          <?php foreach ($categorias as $categoria) :
            $current = is_tax('categoria_produto', $categoria->term_id) ? 'active' : '';  
          ?>
            <li class="nav-item <?= $current ?>">
              <a class="nav-link" href="<?= esc_url(get_term_link($categoria))  ?>"><?= esc_html($categoria->name) ?></a>
            </li>
          <?php endforeach ?>
        </ul>
      </nav>
      <?php endif ?>
    </div>
  </div>
</section>