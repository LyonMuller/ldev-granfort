<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('resources_section')) : while(have_rows('resources_section')) : the_row();
  $title  = get_sub_field('title');

  if($title) :
?>
<div class="owners-resources ps-rel ovf-h bg-light">
  <div class="container">
    <div class="row ais gap-y-2">
      <?php if($title): ?>
        <div class="col-md-12 txt-ct py-9 px-5 wow animate__fadeIn">
          <h2 class="title mb-0 fwn"><?= $title ?></h2>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>