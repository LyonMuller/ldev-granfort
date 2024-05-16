<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_empresas', get_option('page_on_front'))) : while(have_rows('secao_empresas', get_option('page_on_front'))) : the_row();
  $titulo = get_sub_field('titulo');
  $logos  = get_sub_field('logos');
  
  if($titulo || ldev_check_empty($logos) || ldev_check_empty($mapa)) :
?>
<div class="secao-empresas bg-light py-3 ps-rel ovf-h">
  <div class="container">
    <div class="row row-cols-sm-1 gap-y-2 jcc">
      <?php if($titulo): ?>
        <div class="col-md-12 wow animate__fadeInDown">
          <h2 class="titulo ps-rel mb-0 h4 txt-ct fwl"><?= $titulo ?></h2>
        </div>
      <?php endif; if($logos) : ?>
        <div class="col-md-12">
          <div class="row aic gap-y-2 gap-x-3 jcc">
            <?php foreach($logos as $logo) : 
              $link = isset($logo['url']) ? $logo['url'] : '';
              $logo = isset($logo['logo']) ? $logo['logo'] : '';
              if(!$logo) continue;
            ?>
              <div class="col txt-ct">
                <?php if($link): ?><a href="<?= $link ?>" target="_blank"><?php endif; ?>
                <?= ldev_lazy_img($logo['id']) ?>
                <?php if($link): ?></a><?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
