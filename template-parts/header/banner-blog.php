<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php
$args = [
  'post_type'      => 'post',
  'posts_per_page' => 1,
  'orderby'        => 'date',
  'order'          => 'DESC',
  'post_status'    => 'publish',
  'fields'        => 'ids'
];
$query = get_posts($args);
if(!$query) return;
  $post_id     = $query[0];
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
  $thumb = $imagem ? get_the_post_thumbnail_url($post_id) : $placeholder;
?>
<div class="secao-banner__blog ps-rel ovf-h py-6"
  style="--bg: url(<?= $thumb ?>)"
>
  <div class="container ps-rel z1">
    <div class="row aic jcc">
      <div class="col-lg-12 mb-4">
        <h1 class="mb-0 h2 titulo-span-secondary fwl"><b>Último</b> Post</h1>
      </div>
    </div>
    <a href="<?= $link ?>" class="row aic jcc">
      <div class="col-lg-7 image">
        <?= $imagem ? ldev_lazy_img($imagem, 'aspect-16-9 w-100 border-radius', 'thumbnail') : $placeholder; ?>
      </div>
      <div class="col-lg-5">
        <div class="desc-cont border-radius-sm ps-rel z1 px-2 py-2">
          <div class="date flex aic jcb mb-3 border-bottom light-100 pb-1 t-secondary">
            <p class="categoria mb-0 fs-sm fwb" itemprop="articleSection"><?= $categoria ?></p>
            <p class="data mb-0 t-body ff-headings fs-sm fwn" itemprop="datePublished">Publicado em <?= $date ?></p>
          </div>
          <h2 class="h3 fwn ff-headings mb-4 fwl t-primary" itemprop="name"><?= $titulo ?></h2>
          <div class="resumo t-body ff-headings"><?= get_the_excerpt() ?></div>
          <div class="flex jcb aic mt-3">
            <span class="ver-mais fwn ff-headings t-primary">Leia Mais</span>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>
