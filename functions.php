<?php if(!defined('ABSPATH')) die('Access denied');

// Inicia todos os arquivos do functions
foreach (glob(get_template_directory() . "/includes/*/*.php") as $file) {
  require $file;
}