<?php get_header(); ?>
<?php
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article <?php post_class('front-page'); ?>>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
  </article>
<?php endwhile; else : ?>
  <p>Home page is empty. Edit the “Home” page and add blocks.</p>
<?php endif; ?>
<?php get_footer(); ?>