<?php
if (!defined('ABSPATH')) exit;

$section_title = get_field('title') ?: 'Client Reviews';
$quote         = get_field('quote');
$author_name   = get_field('author_name');
$author_meta   = get_field('author_meta');
$avatar_id     = get_field('avatar');
$show_topo     = (bool) get_field('show_topo');

$classes = 'stn-reviews';
$classes .= $show_topo ? ' has-topo' : '';
if (!empty($block['align'])) {
  $classes .= ' align' . esc_attr($block['align']);
}
?>
<section class="<?php echo esc_attr($classes); ?>">
  <div class="stn-container stn-reviews__grid">
    <div class="stn-reviews__title">
      <h2 class="stn-reviews__heading"><?php echo esc_html($section_title); ?></h2>
    </div>

    <div class="stn-reviews__content">
      <?php if ($quote): ?>
        <p class="stn-reviews__quote"><?php echo esc_html($quote); ?></p>
      <?php endif; ?>

      <div class="stn-reviews__author">
        <?php if ($avatar_id): ?>
          <?php echo wp_get_attachment_image($avatar_id, 'thumbnail', false, ['class' => 'stn-reviews__avatar']); ?>
        <?php endif; ?>
        <div>
          <?php if ($author_name): ?>
            <div class="stn-reviews__name"><?php echo esc_html($author_name); ?></div>
          <?php endif; ?>
          <?php if ($author_meta): ?>
            <div class="stn-reviews__meta"><?php echo esc_html($author_meta); ?></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>