<?php if(!defined('ABSPATH')) die('Access denied');?>
<?php if(is_active_sidebar('footer-menu')): ?>
<div class="col-md-12 menu-footer flex jcc gap-1">
  <?php dynamic_sidebar('footer-menu'); ?>
  <?php get_template_part('template-parts/components/buttons/button', 'social-media', ['size' => 1.5]) ?>
</div> 
<?php endif; ?>
