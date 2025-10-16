<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="stn-header">
  <div class="stn-container">

    <a class="stn-brand" href="<?php echo esc_url( home_url('/') ); ?>" aria-label="<?php bloginfo('name'); ?>">
    
      <span class="stn-logo" aria-hidden="true">
        
        <svg viewBox="0 0 48 48" class="stn-logo-svg" role="img" aria-label="Stensland">
          <circle cx="24" cy="24" r="23" />
          <text x="24" y="28" text-anchor="middle">TH</text>
        </svg>
      </span>
      <span class="stn-wordmark">STENSLAND</span>
    </a>

    <?php wp_nav_menu([
      'theme_location' => 'primary',
      'container'      => 'nav',
      'container_class'=> 'stn-nav',
      'menu_class'     => 'stn-menu',
      'fallback_cb'    => false
    ]); ?>

    <div class="stn-actions">
      <!-- Language -->
      <button class="stn-lang" type="button" aria-haspopup="listbox" aria-expanded="false">
        <span>EN</span>
        <svg viewBox="0 0 24 24" class="chev" aria-hidden="true"><path d="M7 10l5 5 5-5"/></svg>
      </button>

      <!-- CTA -->
      <?php
    
        $book_url = function_exists('get_field') ? (get_field('book_call_url','option') ?: '#') : '#';
      ?>
      <a class="stn-cta" href="<?php echo esc_url($book_url); ?>">
        Book a Call
        <svg viewBox="0 0 24 24" class="arrow" aria-hidden="true"><path d="M7 17l9-9M10 8h6v6"/></svg>
      </a>
    </div>
  </div>
</header>

<main class="site-main">