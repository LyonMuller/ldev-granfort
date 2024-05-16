<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_blog')) : while(have_rows('secao_blog')) : the_row();
  $titulo           = get_sub_field('titulo');
  $descricao        = get_sub_field('descricao');
  $selecionar_posts = get_sub_field('selecionar_posts');
  $posts            = get_sub_field('posts');
  
  if(!$selecionar_posts) {
    $args = [
      'posts_per_page' => 4,
      'post_type'      => 'post',
      'post_status'    => 'publish',
      'no_found_rows'  => true,
      'orderby'        => 'date',
      'order'          => 'DESC',
      'fields'          => 'ids'
    ];
    $posts = get_posts($args);
  }
  if($titulo && !empty($posts)) :
?>
<div class="secao-blog py-6 ps-rel ovf-h bg-light">
  <div class="container-fluid">
    <div class="row row-cols-sm-1 gap-y-2 jcc row-cols-md-2 row-cols-lg-4 wow animate__fadeInUp">
      <?php if($titulo): ?>
        <div class="col-md-12 col-lg-12">
          <h2 class="titulo ps-rel mb-0 h4 txt-ct fwl"><?= $titulo ?></h2>
        </div>
      <?php endif; ?>
      <?php foreach ($posts as $i => $post) : if($i == 4) continue; get_template_part('template-parts/components/blog/article', null, ['id' => $post]); endforeach; ?>
      <div class="col-md-12 col-lg-12 txt-ct mt-3">
        <a href="<?= get_permalink(get_option('page_for_posts')) ?>" class="btn-outline-primary">Ver mais conteúdos</a>
      </div>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
