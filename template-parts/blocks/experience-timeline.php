<?php
if (!defined('ABSPATH')) exit;

$title   = get_field('title') ?: __('Professional Experience','stensland');
$bg      = get_field('background_image');
$overlay = get_field('overlay_opacity');
$items   = get_field('items') ?: [];

$overlay = is_numeric($overlay) ? max(0,min(1,$overlay)) : 0.35;

$classes = 'stn-exp has-bg';
if (!empty($block['align'])) $classes .= ' align' . esc_attr($block['align']);
?>
<section class="<?php echo esc_attr($classes); ?>"
  style="--exp-bg: url('<?php echo esc_url($bg ? $bg['url'] : ''); ?>'); --exp-overlay: <?php echo esc_attr($overlay); ?>">

  <div class="stn-exp__overlay" aria-hidden="true"></div>

  <div class="stn-container stn-exp__grid">
    <div class="stn-exp__left">
      <h2 class="stn-exp__title"><?php echo esc_html($title); ?></h2>
    </div>

    <div class="stn-exp__right">

      <div class="stn-exp__viewport" data-visible="3">
        <ul class="stn-exp__track" role="list">
          <?php foreach ($items as $row): 
            $from   = trim($row['start_year'] ?? '');
            $to     = trim($row['end_year'] ?? '');
            $who    = trim($row['company'] ?? '');
            $desc   = trim($row['details'] ?? '');
            $period = trim($from . ' - ' . $to);
          ?>
            <li class="stn-exp__item" tabindex="0">
              <div class="stn-exp__row">
                <div class="stn-exp__years"><?php echo esc_html($period); ?></div>
                <div class="stn-exp__rule" aria-hidden="true"></div>
              </div>

              <?php if ($who): ?>
                <div class="stn-exp__who"><?php echo esc_html($who); ?></div>
              <?php endif; ?>

              <?php if ($desc): ?>
                <div class="stn-exp__desc"><?php echo nl2br(esc_html($desc)); ?></div>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </div>
  </div>
</section>