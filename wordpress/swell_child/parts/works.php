<?php
/**
 * 制作実績カード。投稿のうちカテゴリー「制作実績」（works）を表示する。
 * $args['query'] に koki_get_works() の WP_Query を渡す。
 */
defined('ABSPATH') || exit;
$koki_works = $args['query'] ?? koki_get_works();
while ($koki_works->have_posts()) :
    $koki_works->the_post();
    $koki_url = get_post_meta(get_the_ID(), '_koki_url', true);
    $koki_external = !empty($koki_url);
    $koki_url = $koki_external ? $koki_url : get_permalink();
    $koki_note = get_post_meta(get_the_ID(), '_koki_note', true);
    ?>
              <article class="swiper-slide works__card">
                <a class="works__link" href="<?php echo esc_url($koki_url); ?>"<?php echo $koki_external ? ' target="_blank" rel="noopener noreferrer"' : ''; ?> aria-label="<?php echo esc_attr(get_the_title() . ($koki_external ? '（新しいタブで開く）' : '')); ?>">
                  <?php
                  if (has_post_thumbnail()) {
                      the_post_thumbnail('large', [
                          'class' => 'works__image',
                          'alt' => get_the_title() . 'のサイト画面',
                          'loading' => 'lazy',
                          'decoding' => 'async',
                      ]);
                  }
                  ?>
                  <div class="works__caption">
                    <p class="works__category"><?php echo esc_html(get_post_meta(get_the_ID(), '_koki_kind', true)); ?></p>
                    <h3 class="works__title">
                      <?php the_title(); ?>
                      <?php get_template_part('parts/icon-arrow'); ?>
                    </h3>
                    <p class="works__description">
                      <?php echo esc_html(get_post_meta(get_the_ID(), '_koki_role', true)); ?>
                      <?php if ($koki_note) : ?>
                        <span class="mobile-only"><?php echo esc_html($koki_note); ?></span>
                      <?php endif; ?>
                    </p>
                  </div>
                </a>
              </article>
    <?php
endwhile;
wp_reset_postdata();
