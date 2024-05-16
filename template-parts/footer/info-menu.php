<?php if(!defined('ABSPATH')) die('Access denied');?>
<?php if(is_active_sidebar('footer-menu')): ?>
<div class="col-md-6 col-lg-2 menu-footer my-3">
  <?php dynamic_sidebar('footer-menu'); ?>
</div> 
<?php endif; if(is_active_sidebar('footer-menu-2')):?>
<div class="col-md-6 col-lg-2 menu-footer my-3">
  <?php dynamic_sidebar('footer-menu-2'); ?>
</div> 
<?php endif; ?>
