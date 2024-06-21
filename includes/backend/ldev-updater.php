<?php
// Adicionar a página de opções ao menu do admin
function ldev_add_admin_menu() {
  add_options_page(
    'Theme Updates',
    'Theme Updates',
    'manage_options',
    'theme-updates',
    'ldev_options_page'
  );
}
add_action('admin_menu', 'ldev_add_admin_menu');

// Registrar a configuração
function ldev_settings_init() {
  register_setting(THEME_TEXTDOMAIN, 'ldev_github_token', [
    'type' => 'string',
    'sanitize_callback' => 'sanitize_text_field',
    'default' => ''
  ]);

  add_settings_section(
    'ldev_section',
    __('GitHub Settings', THEME_TEXTDOMAIN),
    '',
    THEME_TEXTDOMAIN
  );

  add_settings_field(
    'ldev_github_token',
    __('GitHub Token', THEME_TEXTDOMAIN),
    'ldev_github_token_render',
    THEME_TEXTDOMAIN,
    'ldev_section'
  );
}
add_action('admin_init', 'ldev_settings_init');

function ldev_github_token_render() {
  $options = get_option('ldev_github_token');
  ?>
  <input type='text' name='ldev_github_token' value='<?php echo esc_attr($options); ?>'>
  <?php
}

function ldev_settings_section_callback() {
  return '';
}

function ldev_options_page() {
  ?>
  <form action='options.php' method='post'>
    <h1>Theme Updates</h1>
    <p><a href="<?= 'https://lyon.dev/?ref=wp-admin&site='.sanitize_text_field(get_bloginfo('name')) ?>"><img src="https://lyon.dev/img/logo-gray.svg" width="70" alt="Lyon.dev_">
    <span style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0; ">Lyon.dev_</span></a></p>
    <?php
    settings_fields(THEME_TEXTDOMAIN);
    do_settings_sections(THEME_TEXTDOMAIN);
    submit_button();
    ?>
  </form>
  <?php
}

// Verificar e atualizar o tema
function ldev_check_for_updates() {
  if (!current_user_can('manage_options')) return;

  $token = get_option('ldev_github_token');
  $repo = 'LyonMuller/'.THEME_REPO;

  if (!$token) return;

  $url = "https://api.github.com/repos/$repo/releases/latest";

  $args = [
    'headers' => [
      'Authorization' => 'token ' . $token,
      'User-Agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url'),
    ],
  ];

  $response = wp_remote_get($url, $args);
  if (is_wp_error($response)) return;

  $body = wp_remote_retrieve_body($response);
  $data = json_decode($body);

  if (isset($data->tag_name)) {
    $latest_version = $data->tag_name;
    $theme = wp_get_theme();
    $current_version = $theme->get('Version');

    if (version_compare($current_version, $latest_version, '<')) {
      ldev_update($data->zipball_url, $token);
    }
  }
}
add_action('init', 'ldev_check_for_updates');

// Baixar e atualizar o tema
function ldev_update($url, $token) {
  $args = [
    'headers' => [
      'Authorization' => 'token ' . $token,
    ],
  ];

  $tmp_file = download_url($url, $args);
  if (is_wp_error($tmp_file)) {
    return false;
  }

  $theme_folder = get_theme_root() . '/' . get_template();
  $unzip_result = unzip_file($tmp_file, $theme_folder);
  unlink($tmp_file);

  if (is_wp_error($unzip_result)) {
    return false;
  }

  // Lista de arquivos e pastas a serem excluídos
  $exclude = ['.dev', 'node_modules', '.git', '.gitignore', 'gulpfile.js', '.package-lock.json', 'package.json'];

  // Função para excluir arquivos e pastas
  foreach ($exclude as $item) {
    $path = $theme_folder . '/' . $item;
    if (file_exists($path)) {
      ldev_delete_files($path);
    }
  }

  return true;
}

function ldev_delete_files($target) {
  if (is_dir($target)) {
    $files = glob($target . '/*', GLOB_MARK); // Pega todos os arquivos/pastas dentro do diretório
    foreach ($files as $file) {
      ldev_delete_files($file); // Deleta cada arquivo/pasta recursivamente
    }
    rmdir($target); // Deleta o diretório
  } elseif (is_file($target)) {
    unlink($target); // Deleta o arquivo
  }
}

// Configurar Cron Job para verificar atualizações
function ldev_schedule_update_check() {
  if (!wp_next_scheduled('ldev_check_for_updates')) {
    wp_schedule_event(time(), 'daily', 'ldev_check_for_updates');
  }
}
add_action('wp', 'ldev_schedule_update_check');

// Limpar Cron Job ao desativar o tema
function ldev_deactivation() {
  $timestamp = wp_next_scheduled('ldev_check_for_updates');
  wp_unschedule_event($timestamp, 'ldev_check_for_updates');
}
add_action('switch_theme', 'ldev_deactivation');