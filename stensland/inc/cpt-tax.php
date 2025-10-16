<?php
add_action('init', function () {
  // Projects
  register_post_type('project', [
    'label' => 'Projects',
    'public' => true,
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-portfolio',
    'supports' => ['title','editor','thumbnail','excerpt'],
  ]);
  // ISO taxonomy for projects
  register_taxonomy('iso', 'project', [
    'label' => 'ISO',
    'hierarchical' => false,
    'show_in_rest' => true,
  ]);
  // Project Status taxonomy 
  register_taxonomy('project_status', 'project', [
    'label' => 'Project Status',
    'hierarchical' => false,
    'show_in_rest' => true,
  ]);

  // Experience
  register_post_type('experience', [
    'label'=>'Experience','public'=>true,'show_in_rest'=>true,
    'menu_icon'=>'dashicons-clock','supports'=>['title','editor','thumbnail','excerpt']
  ]);
  // Testimonials
  register_post_type('testimonial', [
    'label'=>'Testimonials','public'=>true,'show_in_rest'=>true,
    'menu_icon'=>'dashicons-format-quote','supports'=>['title','editor','thumbnail','excerpt']
  ]);
  // Education
  register_post_type('education', [
    'label'=>'Education','public'=>true,'show_in_rest'=>true,
    'menu_icon'=>'dashicons-welcome-learn-more','supports'=>['title','editor','thumbnail','excerpt']
  ]);
});