<?php if (!defined('ABSPATH')) die('Access denied'); ?>
<?php if (have_rows('banner')) : while (have_rows('banner')) : the_row();
    $background           = get_sub_field('background');
    $titulo_especialista  = get_sub_field('titulo_especialista');
    $iframe               = get_sub_field('iframe');
    $telefone             = get_theme_mod('ldev_company_phone');
    $horarios_atendimento = get_theme_mod('ldev_company_hours');
    $whatsapp             = get_theme_mod('ldev_company_whatsapp');
    $nome_da_empresa      = get_theme_mod('ldev_company_name');
    $endereco             = get_theme_mod('ldev_company_address');
    $link_google_maps     = get_theme_mod('ldev_company_google_maps');

    if ($background || $titulo_especialista || $iframe || $telefone || $horarios_atendimento || $whatsapp || $nome_da_empresa || $endereco || $link_google_maps) :
?>
  <section class="secao-banner__contato ovf-h ps-rel" style="--bg: url(<?= $background['url'] ?>)">
    <div class="container z1 ps-rel py-3">
      <div class="row ais">
        <?php if($telefone || $horarios_atendimento || $titulo_especialista || $whatsapp || $nome_da_empresa || $endereco || $link_google_maps): ?>
          <div class="col-lg-5">
            <div class="bg-light border-radius border light-100 py-2 px-2">
              <?php if($telefone): ?>
                <h2 class="fwl mb-4 h4">
                  <a class="t-secondary" href="tel:<?= ldev_phone($telefone) ?>"><?= $telefone ?></a>
                </h2>
              <?php endif; if($horarios_atendimento): ?>
                <p class="fwb h6 t-secondary mb-3">Horário de atendimento</p>
                <p class="t-primary"><?= $horarios_atendimento ?></p>
              <?php endif; ?>
                <hr class="my-3">
              <?php if($titulo_especialista || $whatsapp) : ?>
                <h2 class="fsn"><?= $titulo_especialista ?></h2>
              <?php endif; if($whatsapp) : ?>
                <a class="h4 fwl wpp-link" href="https://api.whatsapp.com/send?phone=<?= ldev_phone($whatsapp) ?>" target="_blank">
                  <?= $whatsapp ?>
                </a>
              <?php endif; ?>
            </div>
            <div class="bg-light border-radius border light-100 py-2 px-2 mt-3">
              <?php if($nome_da_empresa) : ?>
                <h2 class="t-secondary h4 fwn"><?= $nome_da_empresa ?></h2>
              <?php endif; if($endereco) : ?>
                <p class="t-primary my-3"><?= $endereco ?></p>
              <?php endif; if($link_google_maps) : ?>
                <a class="h6 t-primary btn-outline-primary" href="<?= $link_google_maps ?>" target="_blank">Ver no Google Maps</a>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; if($iframe) : ?>
          <div class="col-lg-7 iframe">
            <?= $iframe ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>