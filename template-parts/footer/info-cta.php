<?php if(!defined('ABSPATH')) die('Access denied');
  $titulo             = get_theme_mod('ldev_section_footer_cta_title');
  $texto              = get_theme_mod('ldev_section_footer_cta_text');
  $cta_link           = get_theme_mod('ldev_section_footer_cta_link');
  $cta_bg             = get_theme_mod('ldev_section_footer_cta_bg');
  if((!$titulo || !$texto) && !$cta_link) return;
  if($cta_link !== 'nenhum') :
?>
<div class="col-md-3 col-xl-2 info-cta my-3 <?= $cta_link ?>">
  <?= 
    ldev_btn_customizer(
      $cta_link, 
      [
        'text' => "<h2 class='mb-3 t-wh titulo fsn fwb'>$titulo</h2><p class='t-wh fs-sm fwl ff-headings'>$texto</p>"
      ],
      'grid cta',
      "style='--bg: url($cta_bg)'",
    ) ?>
</div>
<?php endif; ?>