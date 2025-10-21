<?php
$title       = get_field('about_title');
$intro       = get_field('about_intro');
$image_id    = get_field('about_image');
$start_year  = (int) get_field('start_year');
$years_f     = get_field('years_number');
$years_label = get_field('years_label');
$services    = get_field('services');
$bg_id       = get_field('bg_image');
$show_topo   = (bool) get_field('show_topo');

$years = null;
if ($start_year) {
  $years = max(0, (int) date('Y') - $start_year);
} elseif (is_numeric($years_f)) {
  $years = (int) $years_f;
}

$block_id    = 'about-hero-' . ($block['id'] ?? uniqid());
$align_class = isset($block['align']) ? 'align' . $block['align'] : 'alignwide';

// background 
$bg_style = '';
if ($bg_id) {
  $bg_url  = wp_get_attachment_image_url($bg_id, 'full');
  if ($bg_url) $bg_style = ' style="--about-bg:url(' . esc_url($bg_url) . ')"';
}
?>
<section id="<?php echo esc_attr($block_id); ?>" class="stn-about-hero <?php echo esc_attr($align_class); ?><?php echo $show_topo ? ' has-topo' : ''; ?>"<?php echo $bg_style; ?>>
  <div class="stn-container stn-about-grid">
    <div class="stn-about-left">
      <?php if ($title): ?>
        <h2 class="stn-about-title"><?php echo esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if ($intro): ?>
        <div class="stn-about-intro">
          <?php echo wp_kses_post(wpautop($intro)); ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="stn-about-center">
      <?php if ($image_id): ?>
        <figure class="stn-about-portrait">
          <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'portrait']); ?>
          <?php if (!is_null($years) || $years_label): ?>
            <figcaption class="stn-about-years">
              <?php if (!is_null($years)): ?>
                <div class="stn-about-years-num">
                  <?php echo esc_html($years); ?><span>+</span>
                </div>
              <?php endif; ?>
              <?php if ($years_label): ?>
                <div class="stn-about-years-label">
                  <?php echo nl2br(esc_html($years_label)); ?>
                </div>
              <?php endif; ?>
            </figcaption>
          <?php endif; ?>
        </figure>
      <?php endif; ?>
    </div>

    <div class="stn-about-right">
      <?php if ($services && is_array($services)): ?>
        <ul class="stn-about-services">
          <?php foreach ($services as $row): ?>
            <?php if (!empty($row['service'])): ?>
              <li><?php echo esc_html($row['service']); ?></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>


  <div class="stn-about-bg" aria-hidden="true"></div>
</section>