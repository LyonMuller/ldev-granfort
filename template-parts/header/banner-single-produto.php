<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<div class="secao-banner__produto ps-rel ovf-h border-top light-100">
  <div class="container ps-rel z1 border-bottom light-100 py-1">
    <div class="row aic jcb">
      <div class="col-lg-4">
        <a href="<?= get_post_type_archive_link('produto') ?>" class="ff-headings fwn flex aic gap-0-5">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 12L6 8L10 4" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Voltar
        </a>
      </div>
      <div class="col-lg-8 txt-rg breadcrumbs ff-headings">
        <?= ldev_breadcrumbs() ?>
      </div>
    </div>
  </div>
</div>