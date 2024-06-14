<?php if(!defined('ABSPATH')) die('Access denied'); ?>
    </main>
    <footer class="footer-body">
      <?php get_template_part('template-parts/components/modals/popup', 'cookie'); ?>
      <div class="bg-brand py-3">
        <div class="container ps-rel">
          <div class="row jcc txt-ct gap-y-2">
            <?php get_template_part('template-parts/footer/info', 'logo'); ?>
            <?php get_template_part('template-parts/footer/info', 'menu'); ?>
          </div>
        </div>
      </div>
      <div class="copyright bg-brand-darker txt-ct">
        <?php get_template_part('template-parts/footer/copyright') ?>
      </div>
      <?php wp_footer();?>
    </footer>
    <?php get_template_part('template-parts/components/buttons/button', 'whatsapp'); ?>
  </body>
</html>