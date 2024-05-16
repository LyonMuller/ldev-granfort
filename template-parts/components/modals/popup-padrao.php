<?php 
  $titulo = get_theme_mod('ldev_popup_title');
  $headline = get_theme_mod('ldev_popup_headline');
  $background = get_theme_mod('ldev_popup_image');
  $descricao = get_theme_mod('ldev_popup_description');
  $botao_1_texto = get_theme_mod('ldev_popup_button_1_text');
  $botao_1_link = get_theme_mod('ldev_popup_button_1_link');
  $botao_2_texto = get_theme_mod('ldev_popup_button_2_text');
  $botao_2_link = get_theme_mod('ldev_popup_button_2_link');

?>
<div class="modal fade" id="modal-padrao" tabindex="-1" aria-labelledby="modal-padrao-titulo" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content px-1">
      <div class="modal-body p-0 ovf-h border-radius">
        <div class="container">
          <div class="row">
            <div class="col-lg-5 px-0" <?php if($background): ?>style="background: url(<?= $background ?>) no-repeat center / cover"<?php endif; ?>></div>
            <div class="col-lg-7 px-2 ps-rel py-2">
              <button type="button" class="btn-close ps-abs" data-bs-dismiss="modal" aria-label="Fechar">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 1L1 13" stroke="#163963" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M1 1L13 13" stroke="#163963" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </button>
              <?php if($headline): ?>
                <p class="headline mb-3"><?= $headline ?></p>
              <?php endif; if($titulo) : ?>
                <h2 class="modal-title h4 fwl t-primary titulo-span-secondary" id="modal-padrao-titulo"><?= $titulo ?></h2>
              <?php endif; if($descricao) : ?>
                <div class="desc mt-3"><?= $descricao ?></div>
              <?php endif; if(($botao_1_link && $botao_1_texto) || ($botao_2_texto && $botao_2_link)) : ?>
                <div class="row jcc row-cols-md-2 txt-ct mt-4">
                  <?php if($botao_1_link != 'nenhum' && $botao_1_texto): ?>
                    <div class="col">
                      <?= ldev_btn_customizer($botao_1_link, ['text' => $botao_1_texto], 'btn-secondary') ?>
                    </div>
                  <?php endif; if($botao_2_link && $botao_1_texto) : ?>
                    <div class="col">
                      <a href="<?= $botao_2_link ?>" class="btn btn-outline-primary d-block"><?= $botao_2_texto ?></a>
                    </div>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
  $ldev_popup_configs_show = get_theme_mod('ldev_popup_show_options');
  $ldev_popup_configs = get_theme_mod('ldev_popup_configs');
  $exibir = false;
  switch($ldev_popup_configs_show) {
    case 'nenhum' :
      $exibir = false;
      break;
    case 'todas' :
      $exibir = true;
      break;
    case 'home' :
      if (is_front_page()) $exibir = true;
      break;
    case 'blog' :
      if (is_home()) $exibir = true;
      break;
    case 'contato' :
      if (is_page(ldev_get_page_by_template('page-templates/contato.php'))) $exibir = true;
      break;
    case 'produto' :
      if (is_post_type_archive('produto')) $exibir = true;
      break;
    
    default:
      $exibir = false;
  }
  if($exibir) :
?>
<script>
  function closeModalFn(modal){
    modal.style.display = 'none';
    modal.setAttribute('aria-hidden', 'true')
  }
  function showModalFn(modal) {
    modal.style.display = 'block';
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false')
  }

  document.addEventListener('DOMContentLoaded', function() {
    const modalPadrao = document.getElementById('modal-padrao');
    const closeModal  = document.querySelector('#modal-padrao [data-bs-dismiss = "modal"]');
    
    <?php if($ldev_popup_configs == 'instantaneo') : ?>
      setTimeout(() => {showModalFn(modalPadrao)}, 0);
    <?php elseif($ldev_popup_configs == 'exit') : ?>
      document.addEventListener('mouseleave', () => showModalFn(modalPadrao), {once: true});
    <?php elseif($ldev_popup_configs == 'scroll') : ?>
      document.addEventListener('scroll', () => showModalFn(modalPadrao), {once: true});
    <?php endif; ?>
    
    closeModal.onclick = () => closeModalFn(modalPadrao);

    window.onclick = (event) => {
      if (event.target == modalPadrao) closeModalFn(modalPadrao)
    };
  });
</script>
<?php endif; ?>