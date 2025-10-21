<?php

if (!defined('ABSPATH')) exit;

$wrapper_attrs = get_block_wrapper_attributes([
  'class' => 'stn-audits'
]);


$block_id = !empty($block['anchor']) ? sanitize_title($block['anchor']) : ('audits-' . $block['id']);

// ACF fields
$title  = get_field('section_title') ?: __('Audits', 'stensland');
$intro  = get_field('section_intro');
$img_id = get_field('left_image');
$audits = get_field('audits'); 
// Image 
$img_html = '';
if ($img_id) {
  $img_html = wp_get_attachment_image(
    $img_id,
    'large',
    false,
    [
      'class'    => 'stn-audits__image',
      'loading'  => 'lazy',
      'decoding' => 'async',
      'alt'      => trim(wp_strip_all_tags(get_post_meta($img_id, '_wp_attachment_image_alt', true)))
    ]
  );
}


$total = is_array($audits) ? count($audits) : 0;
$cols  = 2;
$last_row_start = max(0, $total - ($total % $cols === 0 ? $cols : $total % $cols));
?>
<section id="<?php echo esc_attr($block_id); ?>" <?php echo $wrapper_attrs; ?>>
  <div class="stn-container stn-audits__wrap">

    <!-- Header:  -->
    <header class="stn-audits__header">
      <h2 class="stn-audits__title"><?php echo esc_html($title); ?></h2>
      <?php if ($intro) : ?>
        <p class="stn-audits__intro"><?php echo wp_kses_post($intro); ?></p>
      <?php endif; ?>
    </header>

    <!-- Main grid:  -->
    <div class="stn-audits__grid">
      <div class="stn-audits__left">
        <?php echo $img_html; ?>
      </div>

      <div class="stn-audits__right">
        <?php if (!empty($audits)) : ?>
          <div class="stn-audits__cards">
            <?php foreach ($audits as $i => $row) :
              $years      = !empty($row['years']) ? $row['years'] : '';
              $item_title = !empty($row['item_title']) ? $row['item_title'] : '';
              $note       = !empty($row['note']) ? $row['note'] : '';
            ?>
              <article class="stn-audits__card">
                <?php if ($years) : ?>
                  <div class="stn-audits__years"><?php echo esc_html($years); ?></div>
                <?php endif; ?>

                <?php if ($item_title) : ?>
                  <h3 class="stn-audits__card-title"><?php echo esc_html($item_title); ?></h3>
                <?php endif; ?>

                <?php if ($note) : ?>
                  <p class="stn-audits__note"><?php echo wp_kses_post($note); ?></p>
                <?php endif; ?>

                <?php if ($i < $last_row_start) : ?>
                  <div class="stn-audits__rule" aria-hidden="true"></div>
                <?php endif; ?>
              </article>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

  </div>
</section>