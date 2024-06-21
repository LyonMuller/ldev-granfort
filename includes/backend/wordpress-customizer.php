<?php
if (is_customize_preview()) {
  class Ldev_Customize
  {
    private $wp_customize;

    public function __construct($wp_customize)
    {
      $this->wp_customize = $wp_customize;
    }

    public function add_panel($id, $title, $priority)
    {
      $this->wp_customize->add_panel($id, [
        'title'    => $title,
        'priority' => $priority,
      ]);
    }

    public function add_section($id, $title, $priority, $panel = null)
    {
      $args = [
        'title'    => $title,
        'priority' => $priority,
      ];
      if ($panel) $args['panel'] = $panel;

      $this->wp_customize->add_section($id, $args);
    }

    public function add_setting_control($id, $section, $label, $type = 'text', $description = '', $choices = [])
    {
      $this->wp_customize->add_setting($id, [
        'default'   => '',
        'transport' => 'refresh',
        'type'      => 'theme_mod',
      ]);

      $control_args = [
        'label'       => $label,
        'section'     => $section,
        'settings'    => $id,
        'description' => $description,
        'type'        => $type,
      ];

      if ($choices) $control_args['choices'] = $choices;

      $this->wp_customize->add_control(new WP_Customize_Control($this->wp_customize, $id, $control_args));
    }

    public function add_image_control($id, $section, $label)
    {
      $this->wp_customize->add_setting($id, [
        'default'   => '',
        'transport' => 'refresh',
      ]);

      $this->wp_customize->add_control(new WP_Customize_Image_Control($this->wp_customize, $id, [
        'label'    => $label,
        'section'  => $section,
        'settings' => $id,
      ]));
    }
    public function add_video_control($id, $section, $label)
    {
      $this->wp_customize->add_setting($id, [
        'default'   => '',
        'transport' => 'refresh',
      ]);

      $this->wp_customize->add_control(new WP_Customize_Media_Control($this->wp_customize, $id, [
        'label'    => $label,
        'section'  => $section,
        'settings' => $id,
        'mime_type' => 'video',
      ]));
    }
  }

  function ldev_customize_register($wp_customize)
  {
    $customizer = new Ldev_Customize($wp_customize);

    // Adding sections
    $customizer->add_section('ldev_section_company_info', 'Company Info', 1);

    $customizer->add_section('ldev_section_header', 'Header', 2);
    $wp_customize->add_panel('ldev_section_footer', [
      'title'    => 'Footer',
      'priority' => 3,
    ]);
    $customizer->add_section('ldev_footer_general', 'Copyright', 0, 'ldev_section_footer');
    $customizer->add_section('ldev_section_others', 'Others', 5);

    // Adding main panel
    $customizer->add_panel('ldev_section_boats', 'Boats', 4);

    // Adding subpanel
    $customizer->add_panel('ldev_section_boats_page', 'Boats Listing Page', 4, 'ldev_section_boats');

    // Adding sections within subpanel
    $section = 'ldev_section_boats_page';
    $customizer->add_section('ldev_section_boats_page_general', 'General', 10, $section);
    $customizer->add_section('ldev_section_boats_page_technology', 'Technology Section', 20, $section);
    $customizer->add_section('ldev_section_boats_page_cta', 'CTA Card', 30, $section);
    $customizer->add_section('ldev_section_boats_page_cta_section', 'CTA Section', 30, $section);

    // Adding settings and controls for General section
    $section = 'ldev_section_boats_page_general';
    $customizer->add_image_control('ldev_boats_background', $section, 'Listing Boats Background (Used as placeholder for video.)',);
    $customizer->add_video_control('ldev_boats_video_background', $section, 'Listing Boats Video Background');
    $customizer->add_setting_control('ldev_boats_title', $section, 'Title', 'text');

    // Adding settings and controls for CTA section
    $section = 'ldev_section_boats_page_cta';
    $customizer->add_setting_control('ldev_products_cta_message', $section, 'The fields below are for the CTA of the Product Listing Page.', 'hidden');    $customizer->add_image_control('ldev_products_cta_background', $section, 'Background');
    $customizer->add_setting_control('ldev_products_cta_title', $section, 'Title', 'text');
    $customizer->add_setting_control('ldev_products_cta_button_text', $section, 'Button Text', 'text');
    $customizer->add_setting_control('ldev_products_cta_button_link', $section, 'Button Link', 'url');
    $customizer->add_setting_control('ldev_products_cta_button_2_text', $section, 'Button 2 Text', 'text');
    $customizer->add_setting_control('ldev_products_cta_button_2_link', $section, 'Button 2 Link', 'select', '', ldev_get_page_list());

    // Adding settings and controls for Technology section
    $section = 'ldev_section_boats_page_technology';
    $customizer->add_setting_control('ldev_boats_technology_section_title', $section, 'Section Title');
    
    $customizer->add_image_control  ('ldev_boats_technology_image_1', $section, 'Image Column 1');
    $customizer->add_setting_control('ldev_boats_technology_subtitle_1', $section, 'Subtitle 1');
    $customizer->add_setting_control('ldev_boats_technology_title_1', $section, 'Title Column 1');
    $customizer->add_setting_control('ldev_boats_technology_text_1', $section, 'Text Column 1', 'textarea');

    // Adicionando configurações e controles para a seção Technology (Coluna 2)
    $customizer->add_image_control  ('ldev_boats_technology_image_2', $section, 'Image Column 2');
    $customizer->add_setting_control('ldev_boats_technology_subtitle_2', $section, 'Subtitle 2');
    $customizer->add_setting_control('ldev_boats_technology_title_2', $section, 'Title Column 2');
    $customizer->add_setting_control('ldev_boats_technology_text_2', $section, 'Text Column 2', 'textarea');

    // Adicionando configurações e controles para a seção Technology (Coluna 3)
    $customizer->add_image_control  ('ldev_boats_technology_image_3', $section, 'Image Column 3');
    $customizer->add_setting_control('ldev_boats_technology_subtitle_3', $section, 'Subtitle 3');
    $customizer->add_setting_control('ldev_boats_technology_title_3', $section, 'Title Column 3');
    $customizer->add_setting_control('ldev_boats_technology_text_3', $section, 'Text Column 3', 'textarea');

    // CTA Section
    $section = 'ldev_section_boats_page_cta_section';
    $customizer->add_setting_control('ldev_boats_cta_section_message', $section, 'The fields below are for the CTA Section of the Product Listing Page.', 'hidden');
    $customizer->add_image_control('ldev_boats_cta_section_background', $section, 'Background');
    $customizer->add_setting_control('ldev_boats_cta_section_title', $section, 'Title', 'text');
    $customizer->add_setting_control('ldev_boats_cta_section_text', $section, 'Text', 'textarea');
    $customizer->add_setting_control('ldev_boats_cta_section_button_text', $section, 'Button Text', 'text');
    $customizer->add_setting_control('ldev_boats_cta_section_button_link', $section, 'Button Link', 'url');
    $customizer->add_setting_control('ldev_boats_cta_section_button_2_text', $section, 'Button 2 Text', 'text');
    $customizer->add_setting_control('ldev_boats_cta_section_button_2_link', $section, 'Button 2 Link', 'select', '', ldev_get_page_list());

    // Additional settings and controls
    $section = 'ldev_section_header';
    $customizer->add_setting_control('ldev_header_left_menu_label', $section, 'Menu Label', 'text');

    $section = 'ldev_section_others';
    $customizer->add_image_control('ldev_404_background', $section, 'Background 404');
    $customizer->add_image_control('ldev_products_background', 'ldev_section_products', 'Background do Banner');

    $customizer->add_setting_control('ldev_products_title', 'ldev_section_products', 'Título', 'text', 'Título do Banner');
    $customizer->add_setting_control('ldev_products_form', 'ldev_section_products', 'Formulário', 'select', 'Formulário da Página do Produto', ldev_get_forms());

    // Popup settings and controls
    $customizer->add_image_control('ldev_popup_orcamento_image', 'ldev_section_popup_orcamento', 'Imagem');
    $customizer->add_setting_control('ldev_popup_orcamento_title', 'ldev_section_popup_orcamento', 'Título', 'text');
    $customizer->add_setting_control('ldev_popup_orcamento_form', 'ldev_section_popup_orcamento', 'Formulário', 'select', '', ldev_get_forms());
    $customizer->add_image_control('ldev_popup_image', 'ldev_section_popup', 'Imagem');
    $customizer->add_setting_control('ldev_popup_show_options', 'ldev_section_popup', 'Exibição da Popup', 'select', '', [
      'nenhum'  => 'Nenhum (ocultar)',
      'todas'   => 'Todas as Páginas',
      'home'    => 'Página Inicial',
      'blog'    => 'Página de Blog',
      'produto' => 'Página de Produtos',
      'contato' => 'Página de Contato',
    ]);
    $customizer->add_setting_control('ldev_popup_configs', 'ldev_section_popup', 'Configuração da Popup', 'select', '', [
      'instantaneo'  => 'Instantâneo',
      'exit'         => 'Intenção de Saída [exit intent]',
      'scroll'       => 'Ao Scrollar',
    ]);
    $customizer->add_setting_control('ldev_popup_headline', 'ldev_section_popup', 'Headline', 'text', 'Título do Banner');
    $customizer->add_setting_control('ldev_popup_title', 'ldev_section_popup', 'Título', 'text');
    $customizer->add_setting_control('ldev_popup_description', 'ldev_section_popup', 'Descrição', 'textarea');
    $customizer->add_setting_control('ldev_popup_button_1_text', 'ldev_section_popup', 'Texto do Botão Orçamento', 'text');
    $customizer->add_setting_control('ldev_popup_button_1_link', 'ldev_section_popup', 'Link do Botão Orçamento', 'select', '', ['nenhum' => 'Nenhum (ocultar)', 'contato' => 'Página de Contato', 'whatsapp' => 'WhatsApp']);
    $customizer->add_setting_control('ldev_popup_button_2_text', 'ldev_section_popup', 'Texto do Botão 2', 'text');
    $customizer->add_setting_control('ldev_popup_button_2_link', 'ldev_section_popup', 'Link do Botão 2', 'select', '', ldev_get_page_list());

    // Footer settings and controls
    $customizer->add_setting_control('ldev_footer_title', 'ldev_footer_general', 'Title', 'text', '');

    // Social Media Links
    $social_networks = [
      'facebook'  => 'Facebook',
      'instagram' => 'Instagram',
      'linkedin'  => 'LinkedIn',
      'youtube'   => 'YouTube',
    ];

    foreach ($social_networks as $network => $label) {
      $customizer->add_setting_control('ldev_company_social_' . $network, 'ldev_section_company_info', $label, 'url');
    }
  }
  add_action('customize_register', 'ldev_customize_register');

  // Funções auxiliares
  function ldev_sanitize_checkbox($value)
  {
    return $value ? true : false;
  }

  function ldev_get_page_list()
  {
    $pages = get_pages();
    $page_list = [];
    foreach ($pages as $page) {
      $page_list[$page->ID] = $page->post_title;
    }
    $archive_pages = get_post_type_archive_link('produto');
    $page_list[$archive_pages] = 'Página de Produtos';
    return $page_list;
  }

  function ldev_get_forms()
  {
    $forms = get_posts([
      'post_type' => 'wpforms',
      'numberposts' => -1,
    ]);
    $forms_list = [];
    foreach ($forms as $form) {
      $forms_list[$form->ID] = $form->post_title;
    }
    return $forms_list;
  }

  function ldev_get_menus()
  {
    $locations = get_nav_menu_locations();
    $menus = [];
    foreach ($locations as $location => $menu_id) {
      $menu = wp_get_nav_menu_object($menu_id);
      $menus[$location] = isset($menu->name) ? $menu->name : 'Nenhum';
    }
    return $menus;
  }
}
