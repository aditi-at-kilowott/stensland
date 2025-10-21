<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>>
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <div class="entry-content"><?php the_content(); ?></div>
  </article>
<?php endwhile; else : ?>
  <p>No content yet. Create a page and add some blocks.</p>
<?php endif; ?>
<?php get_footer(); ?>