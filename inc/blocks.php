<?php

if ( ! defined('ABSPATH') ) exit;

add_action('acf/init', function () {
  if ( ! function_exists('acf_register_block_type') ) return;


  $tpl = static function (string $rel): string {
    return get_theme_file_path($rel);
  };

  // Hero: Intro
  acf_register_block_type([
    'name'            => 'hero-intro',
    'title'           => __('Hero: Intro', 'stensland'),
    'description'     => __('Large greeting + lead text + small meta/scroll/icons.', 'stensland'),
    'category'        => 'layout',
    'icon'            => 'slides',
    'keywords'        => ['hero','intro','heading'],
    'mode'            => 'edit',
    'supports'        => [
      'align'   => ['full','wide'],
      'spacing' => ['margin','padding'],
      'anchor'  => true,
    ],
    'render_template' => $tpl('template-parts/blocks/hero-intro/render.php'),
  ]);

  // 2) About – Hero
  acf_register_block_type([
    'name'            => 'about-hero',
    'title'           => __('About – Hero', 'stensland'),
    'description'     => __('Portrait + years card + services list.', 'stensland'),
    'category'        => 'layout',
    'icon'            => 'id-alt',
    'supports'        => [
      'align'  => ['wide','full'],
      'mode'   => true,
      'anchor' => true,
    ],
    'mode'            => 'preview',
    'render_template' => $tpl('template-parts/blocks/about-hero.php'),
  ]);

  // 3) Audits Section 
  acf_register_block_type([
    'name'            => 'audits-buckets',
    'title'           => __('Audits Section', 'stensland'),
    'description'     => __('Left image + two-column audits list with years, titles and notes.', 'stensland'),
    'category'        => 'layout',
    'icon'            => 'chart-bar',
    'keywords'        => ['audits','experience','timeline'],
    'supports'        => [
      'align'  => ['wide','full'],
      'anchor' => true,
      'mode'   => false,
    ],
    'render_template' => $tpl('template-parts/blocks/audits-buckets/render.php'),
  ]);

  // 4) Client Reviews
  acf_register_block_type([
    'name'            => 'client-reviews',
    'title'           => __('Client Reviews', 'stensland'),
    'description'     => __('Large testimonial: big left title + right quote & author.', 'stensland'),
    'category'        => 'layout',
    'icon'            => 'format-quote',
    'supports'        => [
      'align'  => ['wide','full'],
      'mode'   => true,
      'anchor' => true,
    ],
    'mode'            => 'preview',
    'render_template' => $tpl('template-parts/blocks/client-reviews.php'),
  ]);

  // 5) Work – CTA Row
  acf_register_block_type([
    'name'            => 'work-cta',
    'title'           => __('Work – CTA Row', 'stensland'),
    'description'     => __('Heading, intro, and up to 3 CTA cards with arrow.', 'stensland'),
    'category'        => 'layout',
    'icon'            => 'excerpt-view',
    'keywords'        => ['work','cta','links','buttons'],
    'supports'        => [
      'align'  => ['wide','full'],
      'anchor' => true,
      'mode'   => false,
    ],
    'render_template' => $tpl('template-parts/blocks/work-cta.php'),
  ]);
  // 6) Education – Timeline
    acf_register_block_type([
    'name'            => 'education-timeline',
    'title'           => __('Education Timeline', 'stensland'),
    'description'     => __('Full-width education timeline with background image and vertical dividers.', 'stensland'),
    'category'        => 'layout',
    'icon'            => 'schedule',
    'supports'        => [
      'align' => ['wide', 'full'],
      'mode'  => true,
    ],
    'mode'            => 'preview',
    'render_template' => get_template_directory() . '/template-parts/blocks/education-timeline.php',
  ]);


  // 7) courses – Timeline
  acf_register_block_type([
    'name'            => 'courses-timeline',
    'title'           => __('Courses – Timeline', 'stensland'),
    'description'     => __('Dark section with year, title and details list.', 'stensland'),
    'category'        => 'layout',
    'icon'            => 'welcome-learn-more',
    'keywords'        => ['courses', 'timeline', 'training'],
    'supports'        => [
      'align'  => ['wide','full'],
      'anchor' => true,
      'mode'   => true,
    ],
    'mode'            => 'preview',
    'render_template' => get_theme_file_path('template-parts/blocks/courses-timeline.php'),
  ]);

 // 8)  skills
    acf_register_block_type([
    'name'            => 'skills',
    'title'           => __('Skills', 'stensland'),
    'description'     => __('Two-row section: big heading + intro, then a row of logos.', 'stensland'),
    'category'        => 'layout',
    'icon'            => 'awards',
    'supports'        => [
      'align'  => ['wide','full'],
      'anchor' => true,
      'mode'   => false,
    ],
    'render_template' => get_theme_file_path('template-parts/blocks/skills/render.php'),
  ]);

  // 9) standards grid
    acf_register_block_type([
    'name'            => 'standards-grid',
    'title'           => __('Standards Grid', 'stensland'),
    'description'     => __('Grid of standards with icons, two text lines each.', 'stensland'),
    'category'        => 'layout',
    'icon'            => 'awards',
    'mode'            => 'preview',
    'supports'        => [
      'align' => ['wide', 'full'],
    ],
    'render_template' => get_template_directory() . '/template-parts/blocks/standards-grid/render.php',
  ]);

  // 10) experience – Timeline
   acf_register_block_type([
    'name'            => 'experience-timeline',
    'title'           => __('Experience: Timeline', 'stensland'),
    'description'     => __('Left title + vertical timeline that slides 3-at-a-time.', 'stensland'),
    'category'        => 'layout',
    'icon'            => 'schedule',
    'mode'            => 'preview',
    'supports'        => ['align' => ['wide', 'full']],
    'render_template' => get_template_directory() . '/template-parts/blocks/experience-timeline.php',
  ]);

  // 11) projects – Grid
    acf_register_block_type([
    'name'            => 'projects-grid',
    'title'           => __('Projects Grid','stensland'),
    'description'     => __('Tabbed projects grid','stensland'),
    'category'        => 'layout',
    'icon'            => 'grid-view',
    'keywords'        => ['projects','portfolio','grid'],
    'mode'            => 'preview',
    'supports'        => ['align' => ['wide','full']],
    'render_template' => get_theme_file_path('template-parts/blocks/projects-grid.php'),
    'enqueue_assets'  => function () {

      wp_enqueue_script('stn-projects', get_theme_file_uri('assets/js/projects-tabs.js'), [], '1.0', true);
      wp_enqueue_style('stn-projects',  get_theme_file_uri('assets/css/projects.css'), [], '1.0');
    }
  ]);
});
