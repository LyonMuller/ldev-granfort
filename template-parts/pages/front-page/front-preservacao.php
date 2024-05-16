<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_preservacao')) : while(have_rows('secao_preservacao')) : the_row();
  $titulo = get_sub_field('titulo');
  $itens  = get_sub_field('itens');
  
  if($titulo || !empty($itens)) :
?>
<div class="secao-preservacao py-6 ps-rel">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-3 jcc jcb ais">
      <?php if($titulo || $headline || $descricao): ?>
        <div class="col-md-12 ps-rel wow animate__fadeInDown">
          <?php if($titulo): ?>
            <h2 class="headline fsn ps-rel mb-4 fwl h2 txt-ct"><?= $titulo ?></h2>
          <?php endif; ?>
        </div>
      <?php endif; if(!empty($itens)) : foreach ($itens as $c => $item) : 
        $titulo = isset($item['titulo']) ? $item['titulo']: '';
        $icone  = isset($item['icone']) ? $item['icone']  : '';
        $class = $c === 0 ? 'bg-primary' : ($c === 1 ? 'bg-gradient' : 'bg-secondary');
        if(!$titulo || !$icone) continue;
      ?>
        <div class="col-md-4 ps-rel py-2 px-2 item wow animate__fadeInUp <?= $class ?>">
          <div class="item animate-svg">
            <?= ldev_logo_html($icone['url']) ?>
            <h3 class="titulo h4 fwl t-wh mt-4"><?= $titulo ?></h3>
          </div>
        </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>