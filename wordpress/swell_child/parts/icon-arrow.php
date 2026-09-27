<?php
/**
 * 矢印アイコン。向きは get_template_part('parts/icon-arrow', null, ['modifier' => 'down']) のように渡す。
 * modifier: down / up / reverse
 */
defined('ABSPATH') || exit;
$koki_class = 'icon-arrow';
if (!empty($args['modifier'])) {
    $koki_class .= ' icon-arrow--' . sanitize_html_class($args['modifier']);
}
?>
<svg class="<?php echo esc_attr($koki_class); ?>" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
  <path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
