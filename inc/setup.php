<?php
add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('editor-styles');
  add_theme_support('align-wide');         
  register_nav_menus([
    'primary' => __('Primary Menu','stensland'),
    'footer'  => __('Footer Menu','stensland'),
  ]);
  add_image_size('hero-xl', 1920, 1080, true);
  add_image_size('card-lg', 1200, 900, true);
});