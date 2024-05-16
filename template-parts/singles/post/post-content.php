<?php
$tags = get_the_tags();
$post_id     = get_the_ID();
$categoria   = !empty(get_the_category($post_id)) ? get_the_category($post_id)[0] : '';
$cat_link    = $categoria ? get_category_link($categoria) : '';
$cat_name    = $categoria ? $categoria->name : '';
$author_id   = get_post_field ('post_author', $post_id);
$author_name = get_the_author_meta('display_name', $author_id);
$date        = get_the_date('d/m/Y', $post_id);
?>
<section class="single-post-content mb-6 ps-rel" itemscope itemtype="http://schema.org/BlogPosting">
  <meta itemprop="datePublished" content="<?= get_the_date('Y-m-d') ?>">
  <meta itemprop="dateModified" content="<?= get_the_modified_date('Y-m-d') ?>">
  <meta itemprop="author" content="<?= $user_name ?>">
  <meta itemprop="headline" content="<?= get_the_title() ?>">
  <meta itemprop="description" content="<?= get_the_excerpt() ?>">
  <meta itemprop="image" content="<?= get_the_post_thumbnail_url() ?>">
  <meta itemprop="url" content="<?= get_permalink() ?>">
  <?php if($category_name): ?>
    <meta itemprop="articleSection" content="<?= $category_name ?>">
  <?php endif; ?>
  
  <div class="container ps-rel z1">
    <div class="row ais">
      <?php get_template_part('template-parts/singles/post/post', 'sidebar'); ?>
      <div class="col-lg-9">
        <article class="content-type-normalize">
          <h1 class="fwn ff-headings mb-0"><?= get_the_title() ?></h1>
          <?php if(get_the_excerpt() !== get_the_content()):
              echo '<p class="post-resume h4 fwl t-body ff-headings mb-4">' . get_the_excerpt() . '</p>';
            endif;
          ?>
          <?php the_content() ?>
        </article>
      </div>
    </div>
  </div>
</section>