<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php 
  $titulo = get_search_query();
  $headline = "<b>$wp_query->found_posts resultados</b> foram encontrados com o termo";
?>
<div class="secao-banner banner-standard bg-light ps-rel ovf-h py-6">
  <div class="container ps-rel z1">
    <div class="row aic jcc txt-ct">
      <div class="col-lg-8">
        <?php if($headline): ?>
          <p class="desc mb-3 h3 titulo-span-secondary fwl"><?= $headline ?></p>
        <?php endif; if($titulo): ?>
          <h1 class="mb-4 h2 t-secondary">"<?= $titulo ?>"</h1>
        <?php endif; ?>
        <?php get_template_part('template-parts/components/blog/search', 'form') ?>
      </div>
    </div>
  </div>
</div>