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
});