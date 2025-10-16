<?php
$email   = function_exists('get_field') ? get_field('footer_email','option') : '';
$socials = function_exists('get_field') ? (get_field('footer_socials','option') ?: []) : [];
$licenses = function_exists('get_field') ? (get_field('licenses','option') ?: []) : [];
?>
</main>

<?php if ($licenses && is_array($licenses)) : ?>
<section class="stn-licenses">
  <div class="stn-container">
    <h2 class="stn-licenses__title">Other</h2>
    <ul class="stn-licenses__list">
      <?php foreach ($licenses as $row): ?>
        <li><?php echo esc_html($row['item']); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="stn-licenses__bg" aria-hidden="true"></div>
</section>
<?php endif; ?>

<footer class="stn-footer">
  <div class="stn-container stn-footer__grid">
    <!-- Brand -->
    <a class="stn-brand" href="<?php echo esc_url( home_url('/') ); ?>">
      <span class="stn-logo" aria-hidden="true">
        <svg viewBox="0 0 48 48" class="stn-logo-svg" role="img">
          <circle cx="24" cy="24" r="23" />
          <text x="24" y="28" text-anchor="middle">TH</text>
        </svg>
      </span>
      <span class="stn-wordmark">STENSLAND</span>
    </a>

    <!-- Email -->
    <?php if ($email): ?>
      <a class="stn-footer__email" href="mailto:<?php echo antispambot($email); ?>">
        <?php echo esc_html($email); ?>
      </a>
    <?php else: ?>
      <span class="stn-footer__email is-muted">Add email in Site Settings</span>
    <?php endif; ?>

    <!-- Socials -->
    <ul class="stn-footer__socials">
      <?php foreach ($socials as $s):
        $type = $s['type'] ?? 'custom';
        $url  = $s['url'] ?? '#';
        $label= $s['label'] ?: ucfirst($type);
      ?>
      <li>
        <a href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr($label); ?>">
          <?php if ($type === 'email'): ?>
            <svg viewBox="0 0 24 24"><path d="M3 7l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/></svg>
          <?php elseif ($type === 'linkedin'): ?>
            <svg viewBox="0 0 24 24"><path d="M4 4a2 2 0 114 0 2 2 0 01-4 0zM4 8h4v12H4zM10 8h4v2a4 4 0 014-2c3 0 4 2 4 5v7h-4v-6c0-2-1-3-3-3s-3 1-3 3v6h-4z"/></svg>
          <?php elseif ($type === 'phone'): ?>
            <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.15 8.81 2 2 0 015.14 6.6h3a2 2 0 012 1.72 12.66 12.66 0 00.7 2.81 2 2 0 01-.45 2.11l-1.27 1.27a16 16 0 006.35 6.35l1.27-1.27a2 2 0 012.11-.45 12.66 12.66 0 002.81.7A2 2 0 0122 16.92z"/></svg>
          <?php else: ?>
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/></svg>
          <?php endif; ?>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>