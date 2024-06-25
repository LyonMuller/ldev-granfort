<?php if (!defined('ABSPATH')) die('Access denied'); ?>
<?php if (have_rows('specifications_section')) : while (have_rows('specifications_section')) : the_row();
  $title       = get_sub_field('title');
  $image       = get_sub_field('image');
  $specs       = get_sub_field('specs');
  $other_infos = get_sub_field('other_infos');
  $button      = get_sub_field('button');
  $button_2    = get_sub_field('button_2');
  if($title || $image || !empty($specs) || !empty($other_infos) || !empty($button) || !empty($button_2)) :
?>
<section class="specifications-section py-6 ps-rel bg-light" id="specs" data-section="Technical Specs">
  <div class="container">
    <div class="row jcc row-cols-sm-1 row-cols-md-2 gap-y-2 ais wow animate__fadeIn">
      <?php if ($title) : ?>
        <div class="col-md-12">
          <h2 class="title mb-3 t-up txt-ct fwn flex gap-1 jcc">
            <?= $title ?>
            <span class="divisor t-secondary">/</span> <span class="divisor t-gray">/</span>
            <span class="boat-name"><?= get_the_title() ?></span>
          </h2>
        </div>
      <?php endif; if (!empty($specs)) : foreach($specs as $spec) :
        $options = isset($spec['options']) ? $spec['options'] : [];
        if(!empty($options)):
      ?>
        <div class="col spec-cont ps-rel">
          <div class="spec py-3 px-3 bg-white flex aic flex-wrap jcb">
            <?php foreach ($options as $option) :
              $value = isset($option['value']) ? $option['value']: '';
              $text  = isset($option['text']) ? $option['text']  : '';
              if($value || $text) :
            ?>
              <div class="spec-item ps-rel">
                <?php if($value): ?>
                  <h3 class="h5 mb-0 t-primary"><?= $value ?></h3>
                <?php endif; if($text) : ?>
                  <p class="text fs-sm"><?= $text ?></p>
                <?php endif; ?>
              </div>
            <?php endif; endforeach; ?>
          </div>
        </div>
      <?php endif; endforeach; endif; if (!empty($other_infos)) : ?>
        <div class="col other-infos-cont mt-5 px-2">
          <div class="ps-sticky flex flex-wrap gap-y-1">
            <?php foreach ($other_infos as $info) :
              $title   = isset($info['title']) ? $info['title']    : '';
              $options = isset($info['options']) ? $info['options']: [];
              if($title && !empty($options)) :
            ?>
              <details class="info-cont w-100">
                <summary class="flex aic pb-1 title border-bottom gray-250 mb-3 jcb"><h2 class="h4 mb-0"><?= $title ?></h2></summary>
                <div class="other-infos">
                  <?php foreach ($options as $option) :
                    $value = isset($option['value']) ? $option['value']: '';
                    $text  = isset($option['text']) ? $option['text']  : '';
                    if($value || $text) :
                  ?>
                    <div class="other-info flex jcb py-1">
                      <?php if($text) : ?>
                        <h3 class="text fwn h6 mb-0 t-primary"><?= $text ?></h3>
                      <?php endif; if($value): ?>
                        <h4 class="h6 mb-0 t-primary"><?= $value ?></h4>
                      <?php endif; ?>
                    </div>
                  <?php endif; endforeach; ?>
                </div>
              </details>
            <?php endif; endforeach; ?>
          </div>
        </div>
      <?php endif; if ($image) : ?>
        <div class="col image txt-ct">
          <?= ldev_lazy_img($image['id']) ?>
        </div>
      <?php endif; if(!empty($button) || !empty($button_2)) :?>
        <div class="buttons flex jcc gap-1 col-lg-12 mt-5">
          <?php if ($button) : ldev_btn($button, 'btn-primary'); endif; ?>
          <?php if ($button_2) : ldev_btn($button_2, 'btn-outline primary'); endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>