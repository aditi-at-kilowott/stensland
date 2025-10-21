<?php
if ( ! defined('ABSPATH') ) exit;

$block_id = 'skills-' . ( $block['anchor'] ?? $block['id'] );
$align    = ! empty($block['align']) ? 'align' . $block['align'] : 'alignwide';

$title = get_field('section_title') ?: __('Skills', 'stensland');
$intro = get_field('section_intro');
$logos = get_field('logos'); 
?>
<section id="<?php echo esc_attr($block_id); ?>" class="stn-skills <?php echo esc_attr($align); ?>">
  <div class="stn-container">

    <!-- Row 1: heading + intro -->
    <header class="stn-skills__header">
      <h2 class="stn-skills__title"><?php echo esc_html($title); ?></h2>
      <?php if ($intro) : ?>
        <div class="stn-skills__intro"><?php echo wp_kses_post($intro); ?></div>
      <?php endif; ?>
    </header>

    <!-- Row 2: logos -->
    <?php if (!empty($logos)) : ?>
      <ul class="stn-skills__logos" role="list" aria-label="<?php esc_attr_e('Platforms & tools', 'stensland'); ?>">
        <?php foreach ($logos as $row) :
          $img_id = isset($row['logo_image']) ? (int) $row['logo_image'] : 0;
          if (!$img_id) continue;

          $url = isset($row['logo_link']) ? $row['logo_link'] : '';
          $alt = isset($row['logo_alt'])  ? $row['logo_alt']  : '';

          $img = wp_get_attachment_image(
            $img_id,
            'medium',
            false,
            [
              'class'    => 'stn-skills__logo',
              'loading'  => 'lazy',
              'decoding' => 'async',
              'alt'      => $alt ?: get_post_meta($img_id, '_wp_attachment_image_alt', true),
            ]
          );
        ?>
          <li class="stn-skills__logo-item">
            <?php if (!empty($url)) : ?>
              <a class="stn-skills__logo-link" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">
                <?php echo $img; ?>
              </a>
            <?php else : ?>
              <?php echo $img; ?>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

  </div>
</section>