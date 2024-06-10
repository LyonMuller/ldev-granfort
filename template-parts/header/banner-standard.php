<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php 
  $titulo    = get_sub_field('titulo') ? get_sub_field('titulo'): get_the_title();
  
  if(is_archive()) $titulo = get_the_archive_title();

  $headline  = get_sub_field('headline');
  $mod_date = get_the_modified_date('m/d/Y');
  // check if the current page is the policy page
  $is_policy = get_the_ID() == get_option('wp_page_for_privacy_policy');
  $template = get_page_template_slug();
  $template = str_replace(['page-templates/', '.php'], '', $template);
  
  if($titulo || $headline) :
?>
<div class="secao-banner banner-standard bg-light ps-rel ovf-h py-6" data-template="<?= $template ?>">
  <div class="container ps-rel z1">
    <div class="row aic jcc txt-ct">
      <div class="col-lg-8">
        <?php if($titulo): ?>
          <h1 class="mb-0 h2 fwl"><?= $titulo ?></h1>
        <?php endif; if($mod_date && $is_policy): ?>
          <div class="desc mt-3 fs-sm fwb t-up">Last Update: <?= $mod_date ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endif;?>
