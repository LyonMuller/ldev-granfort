<?php 
  $privacyPolicyUrl = get_permalink( get_option( 'wp_page_for_privacy_policy' ) );
?>

<div class="popup-cookie border light-100 border-radius bg-white box-shadow d-none">
  <p class="popup-cookie__text ff-headings fs-sm">Utilizamos cookies para que você tenha a melhor experiência em nosso site. Para saber mais acesse nossa página de <a href="<?= $privacyPolicyUrl ?>" class="t-secondary fwb">Política de Privacidade.</a></p>
  <button class="popup-cookie__btn btn-outline-primary">Entendi</button>
</div>