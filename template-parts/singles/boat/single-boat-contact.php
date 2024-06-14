<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('contact_section')) : while(have_rows('contact_section')) : the_row();
  $title = get_sub_field('title');
  $text  = get_sub_field('text');
  $form  = get_sub_field('form');
  if(($title || $text) && !empty($form)) :
?>
<section class="contact-form-section py-6 ps-rel ovf-h" id="contact" data-section="Contact">
  <div class="container">
    <div class="row jcc wow animate__fadeIn">
      <?php if($title || $text): ?>
        <div class="col-md-4 px-0">
          <?php if($title): ?>
            <h2 class="title mb-3 fwn"><?= $title ?></h2>
          <?php endif; if($text): ?>
            <div class="text mb-4"><?= $text ?></div>
          <?php endif; ?>
        </div>
      <?php endif; if(!empty($form)) : ?>
        <div class="col-md-7 offset-md-1">
          <?= ldev_form_wp($form) ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
