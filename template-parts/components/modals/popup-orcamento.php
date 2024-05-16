<?php 
  $titulo     = get_theme_mod('ldev_popup_orcamento_title');
  $background = get_theme_mod('ldev_popup_orcamento_image');
  $background_video = $background && preg_match('/\.(mp4|webm)$/i', $background) ? true : false;
  $formulario = get_theme_mod('ldev_popup_orcamento_form');
  if($titulo || $background || $formulario) :
?>
<div class="modal fade" id="modal-orcamento" tabindex="-1" aria-labelledby="modal-orcamento-titulo" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content px-1">
      <div class="modal-body p-0 ovf-h border-radius">
        <div class="container">
          <div class="row">
            <?php if($background): ?>
              <div class="col-lg-5 px-0 ps-rel img-bg" 
                <?php if(!$background_video): ?>style="background: url(<?= $background ?>) no-repeat center / cover"<?php endif; ?>>
                <?php if($background_video): ?>
                  <video class="w-100 h-100 object-cover" muted loop playsinline>
                    <source src="<?= $background ?>" type="video/webm">
                    <source src="<?= $background ?>" type="video/mp4">
                  </video>
                <?php endif; ?>
              </div>
            <?php endif; ?>
            <div class="col-lg-7 px-2 ps-rel py-2">
            <button type="button" class="btn-close ps-abs" data-bs-dismiss="modal" aria-label="Fechar">
              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 1L1 13" stroke="#163963" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M1 1L13 13" stroke="#163963" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <?php if($titulo) : ?>
              <h2 class="modal-title h4 fwl t-primary titulo-span-secondary" id="modal-orcamento-titulo"><?= $titulo ?></h2>
            <?php endif; if($formulario) : ?>
              <div class="desc mt-3"><?= ldev_form_wp($formulario) ?></div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function closeModalFn(modal){
    modal.style.display = 'none';
    modal.setAttribute('aria-hidden', 'true')
    const video = modal.querySelector('video');
    if(video) video.pause();
  }
  function showModalFn(modal) {
    modal.style.display = 'block';
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    const video = modal.querySelector('video');
    if(video) video.play();
  }
  document.addEventListener('DOMContentLoaded', function() {
    const modalPadrao = document.getElementById('modal-orcamento');
    const closeModal  = document.querySelector('#modal-orcamento [data-bs-dismiss = "modal"]');
    const btns = document.querySelectorAll('[href="#popup"], [data-target="#modal-orcamento"], .popup-orcamento');  
    
    btns.forEach((btn) => btn.onclick = () => showModalFn(modalPadrao));

    closeModal.onclick = () => closeModalFn(modalPadrao);
    window.onclick = (event) => {
      if (event.target == modalPadrao) closeModalFn(modalPadrao)
    };
  });
</script>
<?php endif; ?>