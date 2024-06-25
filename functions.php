<?php if(!defined('ABSPATH')) die('Access denied');

define('THEME_TEXTDOMAIN', 'ldev-granfort');
define('THEME_REPO', 'lyonmuller/ldev-granfort');

// Inicia todos os arquivos do functions
foreach (glob(get_template_directory() . "/includes/*/*.php") as $file) {
  require $file;
}