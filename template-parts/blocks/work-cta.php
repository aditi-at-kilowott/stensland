<?php
/** @var array $block */
if (!defined('ABSPATH')) exit;

$title = get_field('title');
$intro = get_field('intro');
$ctas  = get_field('ctas');

$classes = 'stn-work';
if (!empty($block['className'])) $classes .= ' ' . $block['className'];
if (!empty($block['align']))     $classes .= ' align' . $block['align'];
$anchor = !empty($block['anchor']) ? esc_attr($block['anchor']) : '';
?>
<section id="<?php echo $anchor; ?>" class="<?php echo esc_attr($classes); ?>">
  <div class="stn-container stn-work__grid">
    <?php if ($title): ?>
      <h2 class="stn-work__title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <div class="stn-work__content">
      <?php if ($intro): ?>
        <p class="stn-work__intro"><?php echo esc_html($intro); ?></p>
      <?php endif; ?>

      <?php if ($ctas): ?>
        <ul class="stn-work__ctas">
          <?php foreach ($ctas as $row):
            $label   = $row['label'] ?? '';
            $url     = $row['url']   ?? '';
            $new_tab = !empty($row['new_tab']);
            if (!$label || !$url) continue;
          ?>
          <li class="stn-work__item">
            <a class="stn-work__card" href="<?php echo esc_url($url); ?>"
               <?php if ($new_tab): ?> target="_blank" rel="noopener"<?php endif; ?>>
              <span class="stn-work__label"><?php echo esc_html($label); ?></span>
              <span class="stn-work__icon" aria-hidden="true">
                
                <svg viewBox="0 0 24 24" width="20" height="20">
                  <path d="M7 17L17 7M9 7h8v8" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</section>