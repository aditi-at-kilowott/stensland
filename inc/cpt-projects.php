<?php

if (!defined('ABSPATH')) exit;

add_action('init', function () {


  register_post_type('project', [
    'label'  => __('Projects','stensland'),
    'public' => true,
    'menu_icon' => 'dashicons-portfolio',
    'supports' => ['title','editor','thumbnail','excerpt','revisions'],
    'has_archive' => false,
    'rewrite' => ['slug' => 'projects'],
    'show_in_rest' => true,
  ]);


  register_taxonomy('project_group', 'project', [
    'label' => __('Project Groups','stensland'),
    'public' => true,
    'hierarchical' => false,
    'rewrite' => ['slug' => 'project-group'],
    'show_in_rest' => true,
  ]);
});


add_action('after_switch_theme', function () {
  $terms = [
    'ongoing'         => 'Ongoing Projects',
    'customer-closed' => 'Customer Projects – Closed',
    'pm-closed'       => 'Project Manager – Closed',
  ];
  foreach ($terms as $slug => $name) {
    if (!term_exists($slug, 'project_group')) {
      wp_insert_term($name, 'project_group', ['slug' => $slug]);
    }
  }
});