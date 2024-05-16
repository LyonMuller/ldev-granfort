<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('secao_contato')) : while(have_rows('secao_contato')) : the_row();
  $titulo     = get_sub_field('titulo');
  $formulario = get_sub_field('formulario');
  $mapa       = get_sub_field('mapa');

  $titulo_especialista  = isset($mapa['titulo_especialista']) ? $mapa['titulo_especialista'] : '';
  $fachada              = isset($mapa['fachada']) ? $mapa['fachada'] : '';
  $mapa_imagem          = isset($mapa['mapa']) ? $mapa['mapa'] : '';

  $telefone             = get_theme_mod('ldev_company_phone');
  $horarios_atendimento = get_theme_mod('ldev_company_hours');
  $whatsapp             = get_theme_mod('ldev_company_whatsapp');
  $nome_da_empresa      = get_theme_mod('ldev_company_name');
  $endereco             = get_theme_mod('ldev_company_address');
  $link_google_maps     = get_theme_mod('ldev_company_google_maps');
  
  if($titulo || ldev_check_empty($formulario) || ldev_check_empty($mapa)) :
?>
<div class="secao-contato py-6 ps-rel ovf-h">
  <div class="container">
    <div class="row row-cols-sm-1 gap-y-2 jcc">
      <?php if($titulo): ?>
        <div class="col-md-12 mb-4 wow animate__fadeInDown">
          <h2 class="titulo ps-rel mb-0 h4 txt-ct fwl"><?= $titulo ?></h2>
        </div>
      <?php endif; if(ldev_check_empty($formulario)) :
        $titulo = isset($formulario['titulo']) ? $formulario['titulo'] : '';
        $formulario = isset($formulario['formulario']) ? $formulario['formulario'] : '';
        if(empty($titulo) && empty($formulario)) continue;
      ?>
        <div class="col-md-6 wow animate__fadeInUp formulario">
          <div class="bg-light px-2 py-2 border-radius">
            <?php if($titulo): ?>
              <h3 class="h5 fwl mb-4 t-secondary"><?= $titulo ?></h3>
            <?php endif; ?>
            <?= ldev_form_wp($formulario) ?>
          </div>
        </div>
      <?php endif; if($mapa_imagem || $fachada || $titulo_especialista || $telefone || $horarios_atendimento || $whatsapp || $nome_da_empresa || $endereco || $link_google_maps) : ?>
        <div class="col-md-6 flex flex-wrap jcc wow animate__fadeInRight">
          <?php if($fachada || $mapa_imagem): ?>  
            <div class="mapa ovf-h ps-rel w-100">
              <?php if($fachada): ?>
                <?= ldev_lazy_img($fachada['id'], 'ps-abs w-100 border-radius fachada', 'full') ?>
              <?php endif; if($mapa_imagem) : ?>
                <?= ldev_lazy_img($mapa_imagem['id'], 'ps-rel w-100 border-radius mapa-img', 'full') ?>
              <?php endif; ?>
            </div>
          <?php endif; if($nome_da_empresa || $endereco || $link_google_maps) : ?>
            <div class="col-md-10 bg-white ps-rel z1 border-radius info border light-100 py-2 px-2 mt-3">
              <?php if($nome_da_empresa) : ?>
                <h2 class="t-secondary h4 fwn"><?= $nome_da_empresa ?></h2>
              <?php endif; if($endereco) : ?>
                <p class="t-primary my-3"><?= $endereco ?></p>
              <?php endif; if($link_google_maps) : ?>
                <a class="h6 t-primary btn-outline-primary" href="<?= $link_google_maps ?>" target="_blank">Ver no Google Maps</a>
              <?php endif; ?>
            </div>
          <?php endif; if($telefone || $horarios_atendimento || $whatsapp || $titulo_especialista) : ?>
            <div class="col-md-10 border-radius border light-100 py-2 px-2 mt-3">
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
                <a class="h4 fwl t-secondary wpp-link" href="https://api.whatsapp.com/send?phone=<?= ldev_phone($whatsapp) ?>" target="_blank">
                  <?= $whatsapp ?>
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endif;  ?>
    </div>
  </div>
</div>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>
