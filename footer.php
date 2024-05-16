<?php if(!defined('ABSPATH')) die('Access denied'); ?>
      <?php get_template_part('template-parts/components/modals/popup', 'cookie'); ?>
      <?php get_template_part('template-parts/components/modals/popup', 'padrao'); ?>
      <?php get_template_part('template-parts/components/modals/popup', 'orcamento'); ?>
    </main>
    <footer class="ps-rel footer-body bg-primary pt-6">
      <div class="container ps-rel">
        <div class="row aic jcb logo-cont">
          <?php get_template_part('template-parts/footer/info', 'logo'); ?>
          <?php get_template_part('template-parts/footer/info', 'botao'); ?>
          <?php get_template_part('template-parts/footer/info', 'social-media'); ?>
        </div>
        <div class="row row-cols-lg-4 jcb ais gap-y-2 mt-5">
          <?php get_template_part('template-parts/footer/info', 'menu'); ?>
          <?php get_template_part('template-parts/footer/info', 'endereco'); ?>
          <?php get_template_part('template-parts/footer/info', 'contato'); ?>
          <?php get_template_part('template-parts/footer/info', 'cta'); ?>
          <?php get_template_part('template-parts/footer/copyright') ?>
        </div>
      </div>
      <?php wp_footer();?>
    </footer>
    <?php get_template_part('template-parts/components/buttons/botao', 'whatsapp'); ?>
  </body>
</html>