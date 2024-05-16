<?php
if (is_customize_preview()) {

  /**
   * Adiciona campos personalizados na aba de personalização (Customizer).
   * Autor: Lyon.dev_
   */
  function ldev_customize_register($wp_customize)
  {


    // Seção - Informações da Empresa
    $wp_customize->add_section('ldev_section_company_info', [
      'title'    => 'Informações da Empresa',
      'priority' => 30,
    ]);

    // Seção - Produtos
    $wp_customize->add_section('ldev_section_products', [
      'title'    => 'Produtos',
      'priority' => 40,
    ]);

    // Seção - Blog
    $wp_customize->add_section('ldev_section_outros', [
      'title'    => 'Outros',
      'priority' => 40,
    ]);

    // Seção - Popup
    $wp_customize->add_section('ldev_section_popup', [
      'title'    => 'Popup',
      'priority' => 30,
    ]);

    // Seção - Popup de Orçamento
    $wp_customize->add_section('ldev_section_popup_orcamento', [
      'title'    => 'Popup de Orçamento',
      'priority' => 30,
    ]);

    $wp_customize->add_panel('ldev_section_footer', [
      'title'       => 'Footer',
      'description' => 'Configurações do Rodapé',
      'priority'    => 40,
    ]);

    $wp_customize->add_section('ldev_footer_general', [
      'title'    => 'Configurações Gerais',
      'panel'    => 'ldev_section_footer',
      'priority' => 10, 
    ]);
    
    // Campo - Placeholder
    $wp_customize->add_setting('ldev_404_background', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ldev_404_background', [
      'label'    => 'Background 404',
      'section'  => 'ldev_section_outros',
      'settings' => 'ldev_404_background',
    ]));

    // Campo - Placeholder
    $wp_customize->add_setting('ldev_blog_placeholder', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ldev_blog_placeholder', [
      'label'    => 'Imagem de Placeholder',
      'section'  => 'ldev_section_outros',
      'settings' => 'ldev_blog_placeholder',
    ]));

    // Background Produtos
    $wp_customize->add_setting('ldev_products_background', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ldev_products_background', [
      'label'    => 'Background do Banner',
      'section'  => 'ldev_section_products',
      'settings' => 'ldev_products_background',
    ]));

    // Campo - Título
    $wp_customize->add_setting('ldev_products_title', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_products_title', [
      'label'       => 'Título',
      'section'     => 'ldev_section_products',
      'settings'    => 'ldev_products_title',
      'description' => 'Título do Banner',
      'type'        => 'text',
    ]));

    // Campo - Título
    $wp_customize->add_setting('ldev_products_form', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_products_form', [
      'label'       => 'Formulário',
      'section'     => 'ldev_section_products',
      'settings'    => 'ldev_products_form',
      'description' => 'Formulário da Página do Produto',
      'type'        => 'select',
      'choices'     => ldev_get_forms(),
    ]));
        
    
    // CTA - Produtos
    $wp_customize->add_setting('ldev_products_cta_headline', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    // insert message before field
    $wp_customize->add_setting('ldev_products_cta_message', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_products_cta_message', [
      'label'       => 'Os campos abaixo são para a CTA da Página de Listagem de Produtos.',
      'section'     => 'ldev_section_products',
      'settings'    => 'ldev_products_cta_message',
      'type'        => 'hidden',
    ]));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_products_cta_headline', [
      'label'       => 'Headline',
      'section'     => 'ldev_section_products',
      'settings'    => 'ldev_products_cta_headline',
      'type'        => 'text',
    ]));

    $wp_customize->add_setting('ldev_products_cta_title', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_products_cta_title', [
      'label'       => 'Título',
      'section'     => 'ldev_section_products',
      'settings'    => 'ldev_products_cta_title',
      'type'        => 'text',
    ]));

    $wp_customize->add_setting('ldev_products_cta_description', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_products_cta_description', [
      'label'       => 'Descrição',
      'section'     => 'ldev_section_products',
      'settings'    => 'ldev_products_cta_description',
      'type'        => 'textarea',
    ]));

    $wp_customize->add_setting('ldev_products_cta_button_text', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_products_cta_button_text', [
      'label'       => 'Texto do Botão',
      'section'     => 'ldev_section_products',
      'settings'    => 'ldev_products_cta_button_text',
      'type'        => 'text',
    ]));

    $wp_customize->add_setting('ldev_products_cta_button_link', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_products_cta_button_link', [
      'label'       => 'Link do Botão',
      'section'     => 'ldev_section_products',
      'settings'    => 'ldev_products_cta_button_link',
      'type'        => 'select',
      'choices'     => ldev_get_page_list(),
    ]));

    // Background Popup Orçamento
    $wp_customize->add_setting('ldev_popup_orcamento_image', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ldev_popup_orcamento_image', [
      'label'    => 'Imagem',
      'section'  => 'ldev_section_popup_orcamento',
      'settings' => 'ldev_popup_orcamento_image',
    ]));

    // Campo - Título
    $wp_customize->add_setting('ldev_popup_orcamento_title', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_popup_orcamento_title', [
      'label'       => 'Título',
      'section'     => 'ldev_section_popup_orcamento',
      'settings'    => 'ldev_popup_orcamento_title',
      'type'        => 'text',
    ]));

    // Campo - Título
    $wp_customize->add_setting('ldev_popup_orcamento_form', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_popup_orcamento_form', [
      'label'       => 'Formulário',
      'section'     => 'ldev_section_popup_orcamento',
      'settings'    => 'ldev_popup_orcamento_form',
      'description' => '',
      'type'        => 'select',
      'choices'     => ldev_get_forms(),
    ]));

    // end popup orçamento

    // Background Popup
    $wp_customize->add_setting('ldev_popup_image', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ldev_popup_image', [
      'label'    => 'Imagem',
      'section'  => 'ldev_section_popup',
      'settings' => 'ldev_popup_image',
    ]));

    $wp_customize->add_setting('ldev_popup_show_options', [
      'default'   => 'nenhum',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control('ldev_popup_show_options', [
      'label'       => 'Exibição da Popup',
      // 'description' => 'Quando e onde a Popup será exibida?',
      'section'     => 'ldev_section_popup',
      'settings'    => 'ldev_popup_show_options',
      'type'        => 'select',
      'default'     => 'nenhum',
      'choices'     => [
        'nenhum'  => 'Nenhum (ocultar)',
        'todas'   => 'Todas as Páginas',
        'home'    => 'Página Inicial',
        'blog'    => 'Página de Blog',
        'produto' => 'Página de Produtos',
        'contato' => 'Página de Contato',
      ],
    ]);

    $wp_customize->add_setting('ldev_popup_configs', [
      'default'   => 'nenhum',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control('ldev_popup_configs', [
      'label'       => 'Configuração da Popup',
      'section'     => 'ldev_section_popup',
      'settings'    => 'ldev_popup_configs',
      'type'        => 'select',
      'default'     => 'nenhum',
      'choices'     => [
        'instantaneo'  => 'Instantâneo',
        'exit'  => 'Intenção de Saída [exit intent]',
        'scroll'  => 'Ao Scrollar',
      ],
    ]);
      
    // Campo - Headline
    $wp_customize->add_setting('ldev_popup_headline', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_popup_headline', [
      'label'       => 'Headline',
      'section'     => 'ldev_section_popup',
      'settings'    => 'ldev_popup_headline',
      'description' => 'Título do Banner',
      'type'        => 'text',
    ]));

    // Campo - Título
    $wp_customize->add_setting('ldev_popup_title', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_popup_title', [
      'label'       => 'Título',
      'section'     => 'ldev_section_popup',
      'settings'    => 'ldev_popup_title',
      'description' => '',
      'type'        => 'text',
    ]));

    // Campo - Título
    $wp_customize->add_setting('ldev_popup_description', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_popup_description', [
      'label'       => 'Descrição',
      'section'     => 'ldev_section_popup',
      'settings'    => 'ldev_popup_description',
      'description' => '',
      'type'        => 'textarea',
    ]));
    
    $wp_customize->add_setting('ldev_popup_button_1_text', array(
      'default'   => '',
      'type'      => 'theme_mod',
      'transport' => 'refresh',
    ));

    $wp_customize->add_control('ldev_popup_button_1_text', array(
      'label'   => 'Texto do Botão Orçamento',
      'section' => 'ldev_section_popup',
      'type'    => 'text',
    ));

    
    $wp_customize->add_setting('ldev_popup_button_1_link', array(
      'default'   => '',
      'type'      => 'theme_mod',
      'transport' => 'refresh',
    ));

    $wp_customize->add_control('ldev_popup_button_1_link', array(
      'label'   => 'Link do Botão Orçamento',
      'section' => 'ldev_section_popup',
      'type'    => 'select',
      'choices' => ['nenhum' => 'Nenhum (ocultar)', 'contato' => 'Página de Contato', 'whatsapp' => 'WhatsApp'],
    ));

    $wp_customize->add_setting('ldev_popup_button_2_text', array(
      'default'   => '',
      'type'      => 'theme_mod',
      'transport' => 'refresh',
    ));

    $wp_customize->add_control('ldev_popup_button_2_text', array(
      'label'   => 'Texto do Botão 2',
      'section' => 'ldev_section_popup',
      'type'    => 'text',
    ));
    
    $wp_customize->add_setting('ldev_popup_button_2_link', array(
      'default'   => '',
      'type'      => 'theme_mod',
      'transport' => 'refresh',
    ));

    $wp_customize->add_control('ldev_popup_button_2_link', array(
      'label'   => 'Link do Botão 2',
      'section' => 'ldev_section_popup',
      'type'    => 'select',
      'choices' => ldev_get_page_list()
    ));

    // Campo - Título
    $wp_customize->add_setting('ldev_footer_title', [
      'default'   => '',
      'transport' => 'refresh',
      'type'      => 'theme_mod',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_footer_title', [
      'label'       => 'Título',
      'section'     => 'ldev_footer_general',
      'settings'    => 'ldev_footer_title',
      'description' => 'Título que aparece logo abaixo da Logo',
      'type'        => 'text',
    ]));

    // Campo - Texto
    $wp_customize->add_setting('ldev_footer_text', [
      'default'   => '',
      'type'      => 'theme_mod',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_footer_text', [
      'label'    => 'Descrição',
      'section'  => 'ldev_footer_general',
      'settings' => 'ldev_footer_text',
      'type'     => 'textarea',
    ]));

    $wp_customize->add_setting('ldev_section_footer_button_text', array(
      'default'   => '',
      'type'      => 'theme_mod',
      'transport' => 'refresh',
    ));

    $wp_customize->add_control('ldev_section_footer_button_text', array(
      'label'   => 'Texto do Botão',
      'section' => 'ldev_footer_general',
      'type'    => 'text',
    ));
    
    $wp_customize->add_setting('ldev_section_footer_button_link', array(
      'default'   => '',
      'type'      => 'theme_mod',
      'transport' => 'refresh',
    ));

    $wp_customize->add_control('ldev_section_footer_button_link', array(
      'label'   => 'Link do Botão',
      'section' => 'ldev_footer_general',
      'type'    => 'select',
      'choices' => ['nenhum' => 'Nenhum (ocultar)', 'popup' => 'Popup', 'contato' => 'Página de Contato', 'whatsapp' => 'WhatsApp'],
    ));

    $wp_customize->add_section('ldev_section_footer_cta', [
      'title'       => 'CTA',
      'description' => '',
      'panel'       => 'ldev_section_footer', 
      'priority'    => 20,
    ]);

    $wp_customize->add_setting('ldev_section_footer_show_social_media', [
      'default'           => false,
      'type'              => 'theme_mod',
      'sanitize_callback' => 'ldev_sanitize_checkbox',
    ]);
  
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_section_footer_show_social_media', [
      'label'       => 'Exibir Redes Sociais',
      'section'     => 'ldev_footer_general', 
      'settings'    => 'ldev_section_footer_show_social_media',
      'type'        => 'checkbox',
      'description' => 'Marque se você quer ou não exibir as redes sociais no rodapé.',
    ]));


    $wp_customize->add_setting('ldev_section_footer_cta_bg', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ldev_section_footer_cta_bg', [
      'label'    => 'Background',
      'section'  => 'ldev_section_footer_cta',
      'settings' => 'ldev_section_footer_cta_bg',
    ]));

    $wp_customize->add_setting('ldev_section_footer_cta_title', [
      'default' => '',
      'type'    => 'theme_mod',
    ]);

    $wp_customize->add_control('ldev_section_footer_cta_title', [
      'label'       =>'Título da CTA',
      'section'     => 'ldev_section_footer_cta',
      'settings'    => 'ldev_section_footer_cta_title',
      'description' => 'Título da Call to Action.',
      'type'        => 'textarea',
    ]);

    $wp_customize->add_setting('ldev_section_footer_cta_text', [
      'default' => '',
      'type'    => 'theme_mod',
    ]);

    $wp_customize->add_control('ldev_section_footer_cta_text', [
      'label'       =>'Descrição da CTA',
      'section'     => 'ldev_section_footer_cta',
      'settings'    => 'ldev_section_footer_cta_text',
      'description' => 'Descrição da Call to Action.',
      'type'        => 'textarea',
    ]);

    $wp_customize->add_setting('ldev_section_footer_cta_link', array(
      'default'  => '',
      'type'     => 'theme_mod',
    ));

    $wp_customize->add_control('ldev_section_footer_cta_link', array(
      'label'   => 'Link da CTA',
      'section' => 'ldev_section_footer_cta',
      'type'    => 'select',
      'choices' => ['nenhum' => 'Nenhum (ocultar)', 'popup' => 'Popup de Orçamento', 'contato' => 'Página de Contato', 'whatsapp' => 'WhatsApp'],
    ));

    $wp_customize->add_setting('ldev_company_name', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_company_name', [
      'label'    => 'Nome da Empresa',
      'section'  => 'ldev_section_company_info',
      'settings' => 'ldev_company_name',
      'type'     => 'text',
    ]));

    $wp_customize->add_setting('ldev_company_hours', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_company_hours', [
      'label'    => 'Horários de Atendimento',
      'section'  => 'ldev_section_company_info',
      'settings' => 'ldev_company_hours',
      'type'     => 'textarea',
    ]));

    $wp_customize->add_setting('ldev_company_hours', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_company_address', [
      'label'    => 'Endereço',
      'section'  => 'ldev_section_company_info',
      'settings' => 'ldev_company_address',
      'type'     => 'textarea',
    ]));

    $wp_customize->add_setting('ldev_company_google_maps', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_company_google_maps', [
      'label'    => 'Link Google Maps',
      'section'  => 'ldev_section_company_info',
      'settings' => 'ldev_company_google_maps',
      'type'     => 'url',
    ]));
    
    $wp_customize->add_setting('ldev_company_email', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_company_email', [
      'label'    => 'E-mail',
      'section'  => 'ldev_section_company_info',
      'settings' => 'ldev_company_email',
      'type'     => 'email',
    ]));
    
    // Campo - Telefone
    $wp_customize->add_setting('ldev_company_phone', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_company_phone', [
      'label'    => 'Telefone',
      'section'  => 'ldev_section_company_info',
      'settings' => 'ldev_company_phone',
      'type'     => 'tel',
    ]));

    $wp_customize->add_setting('ldev_company_whatsapp', [
      'default'   => '',
      'transport' => 'refresh',
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_company_whatsapp', [
      'label'    => 'WhatsApp',
      'section'  => 'ldev_section_company_info',
      'settings' => 'ldev_company_whatsapp',
      'type'     => 'tel',
    ]));

    // Campo WhatsApp
    $wp_customize->add_setting('ldev_show_whatsapp', [
      'default'           => false,
      'sanitize_callback' => 'ldev_sanitize_checkbox',
    ]);

    $wp_customize->add_control('ldev_show_whatsapp', [
      'label'   => 'Exibir botão do WhatsApp?',
      'section' => 'ldev_section_company_info',
      'type'    => 'checkbox',
    ]);

    // Campos - Links das Redes Sociais na seção Informações da Empresa
    $social_networks = [
      'facebook'  => 'Facebook',
      'instagram' => 'Instagram',
      'linkedin'  => 'LinkedIn',
      'youtube'   => 'YouTube',
    ];

    foreach ($social_networks as $network => $label) {
      // Campo - Link da Rede Social
      $wp_customize->add_setting('ldev_company_social_' . $network, [
        'default'   => '',
        'transport' => 'refresh',
      ]);

      $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ldev_company_social_' . $network, [
        'label'    => $label,
        'section'  => 'ldev_section_company_info',
        'settings' => 'ldev_company_social_' . $network,
        'type'     => 'url',
      ]));
    }
  }
  add_action('customize_register', 'ldev_customize_register');

  // Função de callback para sanitizar o valor do campo checkbox
  function ldev_sanitize_checkbox($value){
    return $value ? true : false;
  }

  function ldev_get_page_list(){
    $pages = get_pages();
    $page_list = [];
    
    foreach ($pages as $page) {
      $page_list[$page->ID] = $page->post_title;
    }

    $archive_pages = get_post_type_archive_link('produto');
    $page_list[$archive_pages] = 'Página de Produtos';

    return $page_list;
  }

  function ldev_get_forms(){
    $forms = get_posts([
      'post_type' => 'wpforms',
      'numberposts' => -1
    ]);
    $forms_list = [];
    foreach ($forms as $form) {
      $forms_list[$form->ID] = $form->post_title;
    }
    return $forms_list;
  }
}

