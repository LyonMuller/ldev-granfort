<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('customer_service_section')) : while(have_rows('customer_service_section')) : the_row();
  $image        = get_sub_field('image');
  $title        = get_sub_field('title');
  $text         = get_sub_field('text');
  $contact_info = get_sub_field('contact_info');

  if(($title || $text || $image) && !empty($contact_info)) :
?>
<div class="contact-customer-service pb-6 ps-rel ovf-h" id="customer-service">
  <div class="container">
    <div class="row jcc wow animate__fadeIn">
      <div class="col-md-8 px-0 bg-light">
        <?php if($image): ?>
          <?= ldev_lazy_img($image['id'], 'mb-0') ?>
        <?php endif; ?>
        <div class="px-3 py-3">
          <?php if($title): ?>
            <h2 class="title mb-3 fwn t-up"><?= $title ?></h2>
          <?php endif; if($text): ?>
            <div class="text mb-4 pb-2 border-bottom gray-250"><?= $text ?></div>
          <?php endif; if(!empty($contact_info)) : ?>
            <div class="contact-info">
              <?php foreach($contact_info as $info) :
                $layout = isset($info['acf_fc_layout']) ? $info['acf_fc_layout'] : null;
                $title = $layout === 'phone' ? 'Phone' : 'Mail';
              ?>
                <div class="<?= $layout === 'phone' ? 'phones mb-4 pb-2 border-bottom gray-250' : 'emails' ?>">
                  <h3 class="fwn h5 mb-4 title flex aic gap-1"><?= $title ?></h3>
                  <table>
                    <?php if($layout === 'phone' && isset($info['phones'])): ?>
                      <?php foreach($info['phones'] as $phone): ?>
                        <tr>
                          <td><p class="t-up t-brand"><?= $phone['label'] ?></p></td>
                          <td><p class="pl-2"><a class="t-primary" href="tel:<?= ldev_phone($phone['phone']) ?>"><?= $phone['phone'] ?></a></p></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php elseif($layout === 'mail' && isset($info['emails'])): ?>
                      <?php foreach($info['emails'] as $email): ?>
                        <tr>
                          <td><p class="t-up t-brand"><?= $email['label'] ?></p></td>
                          <td><p class="pl-2"><a class="t-primary" href="mail:<?= $email['mail'] ?>"><?= $email['mail'] ?></a></p></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </table>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>