<?php
if ( ! defined('ABSPATH') ) exit;

$heading = get_field('hero_heading') ?: 'Hello';
$lead    = get_field('hero_lead') ?: '';
$scroll  = get_field('hero_scroll_label') ?: 'Scroll down';
$icons   = get_field('hero_icons');

if (!$icons && function_exists('get_field')) {
  $email   = get_field('site_email','option');
  $phone   = get_field('site_phone','option');
  $linkedin= get_field('site_linkedin','option');

  $icons = array_filter([
    $email    ? ['type'=>'email','url'=>'mailto:' . $email, 'label'=>'Email'] : null,
    $linkedin ? ['type'=>'linkedin','url'=>$linkedin, 'label'=>'LinkedIn']     : null,
    $phone    ? ['type'=>'phone','url'=>'tel:' . preg_replace('/\s+/', '', $phone), 'label'=>'Call'] : null,
  ]);
}


function stn_hero_icon_svg($type){
  switch ($type) {
    case 'email':   return '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 6h20v12H2z"/><path fill="#fff" d="M4 8l8 6 8-6"/></svg>';
    case 'linkedin':return '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 3a2 2 0 110 4 2 2 0 010-4zM4 8h4v13H4zM10 8h4v2h.1a4.5 4.5 0 014-2c4 0 4.9 2.6 4.9 6v7h-4v-6c0-1.6-.1-3.6-2.2-3.6-2.1 0-2.4 1.7-2.4 3.5v6h-4V8z"/></svg>';
    case 'phone':   return '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 2l4 3-2 3a16 16 0 008 8l3-2 3 4-2 3c-1 .8-3.5 2-8.5-1.9C6 16 4 12.5 3 10c-3.9-5 0-7.5.9-8.5L6 2z"/></svg>';
    default:        return '';
  }
}
$id = 'hero-intro-' . ($block['id'] ?? uniqid());
$classes = 'stn-hero-intro align' . ($block['align'] ?? 'wide');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
  <div class="stn-container">
    <div class="stn-hero-grid">
      <div class="stn-hero-left">
        <h1 class="stn-hero-title"><?php echo esc_html($heading); ?></h1>
        <div class="stn-hero-scroll">
          <?php echo esc_html($scroll); ?> <span aria-hidden="true">↓</span>
        </div>
      </div>

      <div class="stn-hero-right">
        <?php if ($lead) : ?>
          <div class="stn-hero-lead"><?php echo wp_kses_post($lead); ?></div>
        <?php endif; ?>

        <?php if (!empty($icons)) : ?>
          <ul class="stn-hero-icons" role="list">
            <?php foreach ($icons as $item) :
              $type  = $item['type'] ?? 'custom';
              $url   = $item['url']  ?? '#';
              $label = $item['label'] ?? ucfirst($type);
              $custom= $item['custom_icon'] ?? null;

            
              if ($type==='email' && $url && strpos($url,'mailto:')!==0) $url = 'mailto:' . $url;
              if ($type==='phone' && $url && strpos($url,'tel:')!==0)     $url = 'tel:'    . preg_replace('/\s+/', '', $url);
            ?>
              <li>
                <a class="stn-icon-btn" href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr($label); ?>" target="<?php echo $type==='linkedin' || $type==='custom' ? '_blank' : '_self'; ?>" rel="noopener">
                  <span class="stn-icon">
                    <?php
                      if ($type==='custom' && $custom) {
                        echo wp_get_attachment_image($custom, 'thumbnail', false, ['alt'=>'','aria-hidden'=>'true']);
                      } else {
                        echo stn_hero_icon_svg($type);
                      }
                    ?>
                  </span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>