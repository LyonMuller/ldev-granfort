<?php $query = isset($args['query']) ? $args['query'] : false; ?>
<div class="container <?= is_search() ? 'py-6' : 'pt-3 pb-6' ?>">
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gap-y-2">
    <?php if($query) :
      while($query->have_posts()) : $query->the_post();
        get_template_part('template-parts/components/blog/article', null, ['id' => get_the_ID()]);
      endwhile;
    elseif(have_posts()) :
      while(have_posts()) : the_post();
        get_template_part('template-parts/components/blog/article', null, ['id' => get_the_ID()]);
      endwhile;
    ?>
      <div class="w-100 col-12 border-top light-100 pt-1">
        <?php 
          the_posts_pagination([
            'prev_text' => 'Anterior',
            'next_text' => 'Próximo',
            'screen_reader_text' => 'Navegação',
            'aria_label' => 'Posts',
            'class' => 'blog-pagination',
            'total' => $wp_query->max_num_pages,
            'mid_size' => 10,
          ]);
        ?>
      </div>
    <?php else :  ?>
      <div class="w-100 col-12 txt-ct">
        <h2 class="h3 t-primary">Nenhum post encontrado</h2>
        <p class="fs-md">Não encontramos nenhum post com os critérios de busca informados.</p>
      </div>
    <?php endif; ?>
  </div>
</div>