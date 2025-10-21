<?php

if ( ! defined('ABSPATH') ) exit;

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
  load_theme_textdomain('stensland', get_template_directory() . '/languages');

  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('editor-styles');
  add_theme_support('align-wide');
  add_theme_support('responsive-embeds');
  add_theme_support('html5', [
    'search-form','comment-form','comment-list','gallery','caption','script','style'
  ]);


  add_editor_style('assets/css/main.css');

  register_nav_menus([
    'primary' => __('Primary Menu', 'stensland'),
    'footer'  => __('Footer Menu',  'stensland'),
  ]);
});


add_action('wp_enqueue_scripts', function () {
  $css_rel = 'assets/css/main.css';
  $css_abs = get_theme_file_path($css_rel);
  $css_ver = file_exists($css_abs) ? filemtime($css_abs) : '1.0';

  wp_enqueue_style(
    'stensland-main-css',
    get_theme_file_uri($css_rel),
    [],
    $css_ver
  );

  $js_rel = 'assets/js/main.js';
  $js_abs = get_theme_file_path($js_rel);
  if ( file_exists($js_abs) ) {
    wp_enqueue_script(
      'stensland-main-js',
      get_theme_file_uri($js_rel),
      [], 
      filemtime($js_abs),
      true
    );
  }
});


if ( function_exists('acf_add_options_page') ) {
  acf_add_options_page([
    'page_title' => 'Site Settings',
    'menu_title' => 'Site Settings',
    'menu_slug'  => 'site-settings',
    'capability' => 'manage_options',
    'redirect'   => false,
  ]);
}

foreach (['inc/setup.php', 'inc/blocks.php', 'inc/cpt-projects.php', 'inc/helpers.php'] as $rel) {
  $abs = get_theme_file_path($rel);
  if (file_exists($abs)) require_once $abs;
}
  