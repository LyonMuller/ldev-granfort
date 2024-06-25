<?php
// Adicionar a página de opções ao menu "Settings" do admin
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
  register_setting('ldevTheme', 'ldev_github_token', array(
    'type' => 'string',
    'sanitize_callback' => 'sanitize_text_field',
    'default' => ''
  ));

  add_settings_section(
    'ldev_section',
    __('GitHub Settings', THEME_TEXTDOMAIN),
    'ldev_settings_section_callback',
    'ldevTheme'
  );

  add_settings_field(
    'ldev_github_token',
    __('GitHub Token', THEME_TEXTDOMAIN),
    'ldev_github_token_render',
    'ldevTheme',
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
  echo __('Enter your GitHub personal access token here.', THEME_TEXTDOMAIN);
}

function ldev_options_page() {
  ?>
  <form action='options.php' method='post'>
    <h2><?php echo __('Theme Updates', THEME_TEXTDOMAIN); ?></h2>
    <?php
    settings_fields('ldevTheme');
    do_settings_sections('ldevTheme');
    submit_button();
    ?>
  </form>
  <?php
}

// Verificar e atualizar o tema a partir da branch prod
function ldev_check_for_updates() {
  if (!current_user_can('manage_options')) {
    return;
  }

  $token = get_option('ldev_github_token');
  $repo = 'username/repo'; // Substitua pelo seu usuário e repositório do GitHub

  if (!$token) {
    return;
  }

  $url = "https://api.github.com/repos/$repo/branches/prod";
  $args = array(
    'headers' => array(
      'Authorization' => 'token ' . $token,
      'User-Agent' => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url'),
    ),
  );

  $response = wp_remote_get($url, $args);
  if (is_wp_error($response)) {
    return;
  }

  $body = wp_remote_retrieve_body($response);
  $data = json_decode($body);

  if (isset($data->commit->sha)) {
    $latest_commit = $data->commit->sha;
    $theme = wp_get_theme();
    $current_version = $theme->get('Version');

    if ($latest_commit !== get_option('ldev_latest_commit')) {
      ldev_update($latest_commit, $token);
      update_option('ldev_latest_commit', $latest_commit);
    }
  }
}
add_action('init', 'ldev_check_for_updates');

// Baixar e atualizar o tema
function ldev_update($commit_sha, $token) {
  $repo = 'username/repo'; // Substitua pelo seu usuário e repositório do GitHub
  $url = "https://api.github.com/repos/$repo/zipball/prod";
  $args = array(
    'headers' => array(
      'Authorization' => 'token ' . $token,
    ),
  );

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

  return true;
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