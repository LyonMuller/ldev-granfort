<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_formulario')) : while(have_rows('secao_formulario')) : the_row();
  $titulo     = get_sub_field('titulo');
  $formulario = get_sub_field('formulario');

  if($titulo && !empty($formulario)) :
?>
<div class="contato-formulario pt-3 pb-6 ps-rel ovf-h">
  <div class="container">
    <div class="row row-cols-sm-1 gap-y-2 jcc row-cols-md-3 wow animate__fadeIn">
      <div class="col-md-12">
        <?php if($titulo): ?>
          <h2 class="titulo t-primary txt-ct ps-rel h4 mb-4 fwl"><?= $titulo ?></h2>
        <?php endif; if($formulario) : ?>
          <?= ldev_form_wp($formulario) ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
