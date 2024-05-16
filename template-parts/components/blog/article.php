<?php 
  $post_id     = isset($args['id']) ? $args['id'] : '';
  if(!$post_id) return;
  $titulo      = get_the_title($post_id);
  $link        = get_the_permalink($post_id);
  $thumb_id    = get_post_thumbnail_id($post_id);
  $imagem      = has_post_thumbnail($post_id) ? $thumb_id : '';
  $categoria   = !empty(get_the_category($post_id)) ? get_the_category($post_id)[0]->name : '';
  $author_id   = get_post_field ('post_author', $post_id);
  $author_name = get_the_author_meta('display_name', $author_id);
  $date        = get_the_date('d/m/Y', $post_id);
  $excerpt     = get_the_excerpt($post_id);
  $placeholder = get_theme_mod('ldev_blog_placeholder') ? wp_get_attachment_image(attachment_url_to_postid(get_theme_mod('ldev_blog_placeholder')), 'full', false, ['class' => 'aspect-16-9']) : '<div class="ldev-placeholder"></div>';
?>
<article class="post flex" itemscope itemtype="https://schema.org/Article">
  <a href="<?= $link ?>" itemprop="url" class="gap-1 w-100">
    <div class="imagem ps-rel">
      <?= $imagem ? ldev_lazy_img($imagem, 'aspect-16-9 w-100 border-radius-sm', 'thumbnail') : $placeholder ?>
    </div>
    <div class="desc-cont border-radius-sm ps-rel z1 px-2 py-2 bg-white">
      <div class="date flex aic jcb mb-3 border-bottom light-100 pb-1 t-secondary">
        <p class="data mb-0 t-body ff-headings fs-sm fwn" itemprop="datePublished"><?= $date ?></p>
        <p class="categoria mb-0 fs-sm fwb" itemprop="articleSection"><?= $categoria ?></p>
      </div>
      <h3 class="h5 fwn ff-headings mb-4 fwl t-primary" itemprop="name"><?= $titulo ?></h3>
      <div class="flex jcb aic">
        <span class="ver-mais fwn t-primary">Leia Mais</span>
      </div>
    </div>
  </a>
</article>