<?php if(!defined('ABSPATH')) die('Access denied');
  $telefone = get_theme_mod('ldev_company_phone');
  $whatsapp = get_theme_mod('ldev_company_whatsapp');
  $ldev_company_hours = get_theme_mod('ldev_company_hours');
  if(!$telefone || !$whatsapp || !$ldev_company_hours) return;
?>
<div class="col-md-6 col-lg-3 info-logo my-3">
  <h2 class="h4 fwl mb-4 t-wh">Fale Conosco</h2>
  <?php if($telefone): ?>
    <p>
      <a href="tel:<?= ldev_phone($telefone) ?>" class="t-wh">
        <?= $telefone ?>
      </a>
    </p>
  <?php endif; if($whatsapp) : ?>
  <p>
    <a class="t-wh" href="https://api.whatsapp.com/send?phone=55<?= ldev_phone($whatsapp) ?>" target="_blank">
      <?= $whatsapp ?>
    </a>
  </p>
  <?php endif; if($ldev_company_hours) : ?>
  <p class="t-wh fwb">Horários de Atendimento</p>
  <p class="t-wh fs-sm"><?= $ldev_company_hours ?></p>
  <?php endif;  ?>
</div>