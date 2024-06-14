<?php 
  $privacyPolicyUrl = get_permalink( get_option( 'wp_page_for_privacy_policy' ) );
?>

<div class="popup-cookie border light-100 border-radius bg-white box-shadow d-none">
<p class="popup-cookie__text ff-headings fs-sm mb-1">
    <?php printf('We use cookies to ensure you have the best experience on our website.', THEME_TEXTDOMAIN); ?>
  </p>
  <p class="">  
  <?php
      printf(
        __('To learn more, visit our <a href="%1$s" class="fwb cta">Privacy Policy</a> page.'),
        esc_url($privacyPolicyUrl)
      );
    ?>
  </p>
  <button class="popup-cookie__btn"><?php printf('Accept', THEME_TEXTDOMAIN)?></button>
</div>