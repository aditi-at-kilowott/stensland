<?php
if (!defined('ABSPATH')) exit;

$block_id = 'standards-' . ($block['anchor'] ?? $block['id']);
$align    = !empty($block['align']) ? 'align' . $block['align'] : 'alignwide';


$title = get_field('title') ?: __('Standards', 'stensland');
$intro = get_field('intro');
$items = get_field('items'); 
?>
<section id="<?php echo esc_attr($block_id); ?>" class="stn-standards <?php echo esc_attr($align); ?>">
  <div class="stn-container">

    <!-- Header -->
    <header class="stn-standards__header">
      <h2 class="stn-standards__title"><?php echo esc_html($title); ?></h2>
      <?php if ($intro) : ?>
        <p class="stn-standards__intro"><?php echo wp_kses_post($intro); ?></p>
      <?php endif; ?>
    </header>

    <?php if (!empty($items)) : ?>
      <div class="stn-standards__grid">
        <?php foreach ($items as $card) :
          $img     = $card['icon_image'] ?? null;   
          $heading = $card['heading'] ?? '';
          $lines   = $card['lines']   ?? [];
        ?>
          <article class="stn-standards__card">
            <?php if ($img) : ?>
              <div class="stn-standards__icon">
                <?php
                  echo wp_get_attachment_image(
                    $img['ID'],
                    'medium',
                    false,
                    [
                      'alt'      => esc_attr($img['alt'] ?? ''),
                      'loading'  => 'lazy',
                      'decoding' => 'async',
                    ]
                  );
                ?>
              </div>
            <?php endif; ?>

            <div class="stn-standards__body">
              <?php if ($heading) : ?>
                <h3 class="stn-standards__heading"><?php echo esc_html($heading); ?></h3>
              <?php endif; ?>

              <?php if (!empty($lines)) : ?>
                <ul class="stn-standards__list">
                  <?php foreach ($lines as $row) :
                    $line = $row['line'] ?? '';
                    if (!$line) continue; ?>
                    <li><?php echo esc_html($line); ?></li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>