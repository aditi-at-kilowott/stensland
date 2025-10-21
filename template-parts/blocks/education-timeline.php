<?php
if (!defined('ABSPATH')) exit;

$title           = get_field('title') ?: 'Education';
$bg              = get_field('bg_image');
$overlay_opacity = get_field('overlay_opacity');
$items           = get_field('items');

$overlay_opacity = is_numeric($overlay_opacity) ? max(0, min(1, $overlay_opacity)) : 0.35;

$classes = 'stn-edu has-bg';
if (!empty($block['align'])) $classes .= ' align' . esc_attr($block['align']);
?>
<section class="<?php echo esc_attr($classes); ?>"
         style="--edu-bg: url('<?php echo esc_url($bg ?: ''); ?>');
                --edu-overlay: <?php echo esc_attr($overlay_opacity); ?>;">
  <div class="stn-edu__overlay" aria-hidden="true"></div>
  <div class="stn-container stn-edu__grid">
    <div class="stn-edu__title">
      <h2 class="stn-edu__heading"><?php echo esc_html($title); ?></h2>
    </div>

    <?php if ($items): ?>
      <ul class="stn-edu__list" role="list">
        <?php foreach ($items as $i): 
          $year        = trim($i['year'] ?? '');
          $heading     = trim($i['heading'] ?? '');
          $institution = trim($i['institution'] ?? '');
          $break       = !empty($i['break_heading']);
        ?>
          <li class="stn-edu__item">
            <?php if ($year): ?>
              <div class="stn-edu__year"><?php echo esc_html($year); ?></div>
            <?php endif; ?>

            <div class="stn-edu__divider" aria-hidden="true"></div>

            <div class="stn-edu__text">
              <?php if ($heading): ?>
                <div class="stn-edu__sub">
                  <?php echo $break ? nl2br(esc_html($heading)) : esc_html($heading); ?>
                </div>
              <?php endif; ?>
              <?php if ($institution): ?>
                <div class="stn-edu__inst"><?php echo esc_html($institution); ?></div>
              <?php endif; ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</section>
