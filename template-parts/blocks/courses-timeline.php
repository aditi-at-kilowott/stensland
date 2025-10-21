<?php
if (!defined('ABSPATH')) exit;

$block_id = 'courses-' . ($block['anchor'] ?? $block['id']);
$align    = !empty($block['align']) ? 'align' . $block['align'] : 'alignwide';

$title     = get_field('section_title') ?: __('Courses', 'stensland');
$show_topo = get_field('show_topo');
$rows      = get_field('courses') ?: [];


usort($rows, function($a, $b) {
  $ay = isset($a['year']) ? (int)preg_replace('/\D/','',$a['year']) : 0;
  $by = isset($b['year']) ? (int)preg_replace('/\D/','',$b['year']) : 0;
  return $by <=> $ay;
});
?>
<section id="<?php echo esc_attr($block_id); ?>"
         class="stn-courses <?php echo esc_attr($align); ?><?php echo $show_topo ? ' has-topo' : ''; ?>">
  <div class="stn-container">
    <div class="stn-courses__grid">
      <h2 class="stn-courses__title"><?php echo esc_html($title); ?></h2>

      <?php if ($rows): ?>
        <ul class="stn-courses__list" role="list">
          <?php foreach ($rows as $r): ?>
            <?php
              $year    = trim($r['year'] ?? '');
              $ctitle  = trim($r['title'] ?? '');
              $details = trim($r['details'] ?? '');
            ?>
            <li class="stn-courses__item">
              <div class="stn-courses__year"><?php echo esc_html($year); ?></div>
              <div class="stn-courses__content">
                <?php if ($ctitle): ?>
                  <div class="stn-courses__item-title"><?php echo esc_html($ctitle); ?></div>
                <?php endif; ?>
                <?php if ($details): ?>
                  <div class="stn-courses__details">
                    <?php echo wp_kses_post(nl2br($details)); ?>
                  </div>
                <?php endif; ?>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</section>