<?php 
  $imagem = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
<section class="secao-banner__post pt-6" style="--bg: url(<?= $imagem ?>)">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 banner-post__img aspect-16-9 border-radius">
      </div>
    </div>
  </div>
</section>