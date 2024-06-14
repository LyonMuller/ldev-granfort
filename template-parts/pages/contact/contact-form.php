<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('form_section')) : while(have_rows('form_section')) : the_row();
  $title = get_sub_field('title');
  $text  = get_sub_field('text');
  $form  = get_sub_field('form');

  if(($title || $text) && !empty($form)) :
?>
<div class="contact-form-section py-6 ps-rel ovf-h">
  <div class="container">
    <div class="row jcc wow animate__fadeIn">
      <div class="col-md-8 px-0">
        <?php if($title): ?>
          <h2 class="title txt-ct mb-3 fwl"><?= $title ?></h2>
        <?php endif; if($text): ?>
          <div class="text txt-ct mb-4"><?= $text ?></div>
        <?php endif; if($form) : ?>
          <?= ldev_form_wp($form) ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
