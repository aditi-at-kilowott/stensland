<?php

if (!defined('ABSPATH')) exit;
if (!function_exists('stn_project_card')) {
  function stn_project_card($p){
    $role      = function_exists('get_field') ? get_field('role', $p->ID) : '';
    $company   = function_exists('get_field') ? (get_field('company', $p->ID) ?: get_the_title($p)) : get_the_title($p);
    $period    = function_exists('get_field') ? get_field('period', $p->ID) : null;
    $summary   = function_exists('get_field') ? get_field('summary', $p->ID) : '';
    $standards = function_exists('get_field') ? (get_field('standards', $p->ID) ?: []) : [];


    $img_html = '';
    if (function_exists('get_field')) {
      $acf_img = get_field('card_image', $p->ID);
      if (is_array($acf_img) && !empty($acf_img['ID'])) {
        $img_html = wp_get_attachment_image($acf_img['ID'], 'large', false, ['class'=>'stn-prj__img']);
      } elseif (is_string($acf_img) && $acf_img) {
        $img_html = '<img class="stn-prj__img" src="'.esc_url($acf_img).'" alt="">';
      }
    }
    if (!$img_html) {
      $img_html = get_the_post_thumbnail($p->ID, 'large', ['class'=>'stn-prj__img']);
    }

    $start = is_array($period) ? ($period['start'] ?? '') : '';
    $end   = is_array($period) ? ($period['end']   ?? '') : '';
    ?>
    <article class="stn-prj">
      <div class="stn-prj__media"><?php echo $img_html ?: ''; ?></div>

      <div class="stn-prj__meta">
  <?php if ($role): ?>
    <div class="stn-prj__role">Role: <?php echo esc_html($role); ?></div>
  <?php endif; ?>
  <?php if ($start || $end): ?>
    <div class="stn-prj__time"><?php echo esc_html(trim("$start–$end","–")); ?></div>
  <?php endif; ?>
</div>

      <?php if ($company): ?><h3 class="stn-prj__title"><?php echo esc_html($company); ?></h3><?php endif; ?>
      <?php if ($summary): ?><p class="stn-prj__summary"><?php echo esc_html($summary); ?></p><?php endif; ?>

      <?php if (!empty($standards) && is_array($standards)): ?>
        <ul class="stn-prj__badges" role="list">
          <?php foreach ($standards as $row): if (!empty($row['label'])): ?>
            <li class="stn-prj__badge"><?php echo esc_html($row['label']); ?></li>
          <?php endif; endforeach; ?>
        </ul>
      <?php endif; ?>
    </article>
    <?php
  }
}


$heading = function_exists('get_field') ? (get_field('heading') ?: 'Projects') : 'Projects';
$intro   = function_exists('get_field') ? get_field('intro') : '';


$terms = [];
if (function_exists('have_rows') && have_rows('tabs')) {
  while (have_rows('tabs')) { the_row();
    $term  = get_sub_field('group');       
    $label = trim((string) get_sub_field('label'));
    if ($term && !is_wp_error($term)) {
      $terms[] = (object)['term'=>$term, 'label'=>($label ?: $term->name)];
    }
  }
}
if (!$terms) {
  $defaults = [
    'ongoing'         => 'Ongoing Projects',
    'customer-closed' => 'Customer Projects – Closed',
    'pm-closed'       => 'Project Manager – Closed',
  ];
  foreach ($defaults as $slug => $label) {
    $t = get_term_by('slug', $slug, 'project_group');
    if ($t && !is_wp_error($t)) {
      $terms[] = (object)['term'=>$t, 'label'=>$label];
    }
  }
}
?>
<section class="stn-projects">
  <div class="stn-container">
    <div class="stn-projects__layout">

    
      <aside class="stn-projects__left">
        <?php if ($heading): ?><h2 class="stn-title"><?php echo esc_html($heading); ?></h2><?php endif; ?>
        <?php if ($intro):   ?><p class="stn-intro"><?php echo esc_html($intro); ?></p><?php endif; ?>

        <?php if ($terms): ?>
          <nav class="stn-projects__bar">
            <ul class="stn-tabs" role="tablist">
              <?php foreach ($terms as $i => $item): ?>
                <li>
                  <button class="stn-tab <?php echo $i===0 ? 'is-active' : ''; ?>"
                          role="tab"
                          aria-selected="<?php echo $i===0 ? 'true' : 'false'; ?>"
                          data-target="#panel-<?php echo esc_attr($item->term->slug); ?>">
                    <?php echo esc_html($item->label); ?>
                  </button>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>
        <?php endif; ?>
      </aside>


      <div class="stn-projects__right">
        <?php if ($terms): foreach ($terms as $i => $item): $term = $item->term; ?>
          <div id="panel-<?php echo esc_attr($term->slug); ?>"
               class="stn-panel <?php echo $i===0 ? 'is-active' : ''; ?>"
               role="tabpanel">
            <div class="stn-grid">
              <?php
              $q = new WP_Query([
                'post_type'      => 'project',
                'posts_per_page' => -1,
                'tax_query'      => [[
                  'taxonomy' => 'project_group',
                  'field'    => 'term_id',
                  'terms'    => $term->term_id,
                ]],
                'orderby'        => 'date',
                'order'          => 'DESC',
              ]);
              if ($q->have_posts()):
                while ($q->have_posts()): $q->the_post();
                  stn_project_card($q->post);
                endwhile; wp_reset_postdata();
              else:
                echo '<p>No projects in this category yet.</p>';
              endif;
              ?>
            </div>
          </div>
        <?php endforeach; endif; ?>
      </div>

    </div>
  </div>
</section>