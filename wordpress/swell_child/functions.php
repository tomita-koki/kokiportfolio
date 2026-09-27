<?php
/**
 * SWELL 子テーマ「とこ」ポートフォリオ。
 * トップ（front-page.php）だけ独自のHTML・CSS・JSで描画し、他のページは SWELL の表示を使う。
 */
defined('ABSPATH') || exit;

/** トップの title。SWELL の title-tag 出力にこの値を渡す。 */
function koki_front_title() {
    return 'とこ | 話すことから、はじまるWeb制作。';
}

/** トップの meta description / og:description。 */
function koki_front_description() {
    return '個人で活動するあなたの、Web制作の相談相手。想いや困りごとを一緒に整理し、デザインからコーディング、WordPress、公開後の更新までひとつの窓口でお手伝いします。';
}

add_filter('pre_get_document_title', function ($title) {
    return is_front_page() ? koki_front_title() : $title;
}, 99);

/** 制作実績（カテゴリー works の公開済み投稿）。表示順の昇順、同じ順なら新しい順。 */
function koki_get_works() {
    return new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'category_name' => 'works',
        'posts_per_page' => -1,
        'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC'],
        'ignore_sticky_posts' => true,
    ]);
}

/** Contact Form 7 が設定済みならそのフォーム、未設定なら送信しない確認用フォームを出す。 */
function koki_the_contact_form() {
    $form_id = preg_replace('/[^a-zA-Z0-9_-]/', '', (string) get_theme_mod('koki_cf7_id', ''));
    if ($form_id && shortcode_exists('contact-form-7')) {
        echo do_shortcode('[contact-form-7 id="' . $form_id . '" html_class="contact__form"]');
        return;
    }
    get_template_part('parts/contact-form');
}

/** Vite の manifest.json（npm run build で生成）。 */
function koki_vite_manifest() {
    static $manifest = null;
    if ($manifest === null) {
        $path = __DIR__ . '/assets/.vite/manifest.json';
        $manifest = is_readable($path) ? json_decode(file_get_contents($path), true) : [];
    }
    return $manifest;
}

add_action('wp_enqueue_scripts', function () {
    if (!is_front_page()) {
        wp_enqueue_style('koki-child', get_stylesheet_uri(), [], filemtime(__DIR__ . '/style.css'));
        return;
    }
    $base = get_stylesheet_directory_uri() . '/assets/';
    $manifest = koki_vite_manifest();
    wp_enqueue_style('koki-font', 'https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;500;700&display=swap', [], null);
    $css = [];
    foreach (['styles/main.css', 'scripts/main.js'] as $entry) {
        if (empty($manifest[$entry])) continue;
        if (str_ends_with($manifest[$entry]['file'], '.css')) $css[] = $manifest[$entry]['file'];
        foreach ($manifest[$entry]['css'] ?? [] as $file) $css[] = $file;
    }
    foreach (array_unique($css) as $i => $file) {
        wp_enqueue_style('koki-front-' . $i, $base . $file, [], null);
    }
    if (!empty($manifest['scripts/main.js'])) {
        wp_enqueue_script('koki-front-main', $base . $manifest['scripts/main.js']['file'], [], null, true);
    }
    wp_enqueue_style('koki-child', get_stylesheet_uri(), $css ? ['koki-front-0'] : [], filemtime(__DIR__ . '/style.css'));
}, 100);

/**
 * 独自トップでは親テーマ SWELL の CSS・JS を使わない。SWELL は部品ごとに分けて読み込み、
 * wp_footer の途中でも JS を追加するので、出力の直前に親テーマのフォルダから来るものをまとめて外す。
 * WordPress 本体とプラグインの分は残す。
 */
function koki_dequeue_parent_assets() {
    if (!is_front_page()) return;
    $parent = trailingslashit(get_template_directory_uri()); // swell_child と区別するため末尾の / が必要
    foreach ([wp_styles(), wp_scripts()] as $deps) {
        foreach ($deps->queue as $handle) {
            $src = $deps->registered[$handle]->src ?? '';
            $is_swell = (is_string($src) && strpos($src, $parent) === 0) || in_array($handle, ['main_style', 'swell_custom'], true);
            if ($is_swell) {
                $deps instanceof WP_Styles ? wp_dequeue_style($handle) : wp_dequeue_script($handle);
            }
        }
    }
}
add_action('wp_print_styles', 'koki_dequeue_parent_assets', 100);
add_action('wp_print_scripts', 'koki_dequeue_parent_assets', 100);
add_action('wp_print_footer_scripts', 'koki_dequeue_parent_assets', 1);

add_filter('script_loader_tag', function ($tag, $handle) {
    if ($handle !== 'koki-front-main') return $tag;
    $tag = preg_replace('/\s+type=["\x27][^"\x27]*["\x27]/', '', $tag);
    return str_replace('<script ', '<script type="module" ', $tag);
}, 10, 2);

add_action('after_switch_theme', function () {
    if (!term_exists('works', 'category')) wp_insert_term('制作実績', 'category', ['slug' => 'works']);
});

/* 投稿編集画面の「制作実績の表示内容」 */
add_action('add_meta_boxes', function () {
    add_meta_box('koki-work', '制作実績の表示内容', function ($post) {
        wp_nonce_field('koki_save_work', 'koki_work_nonce');
        echo '<p>制作実績として表示するには、カテゴリー「制作実績」を選択し、アイキャッチ画像を設定してください。</p>';
        foreach (['kind' => '種別（実案件・自主制作など）', 'role' => '担当範囲', 'note' => '補足文（任意）', 'url' => 'リンク先URL'] as $key => $label) {
            echo '<p><label>' . esc_html($label) . '<br><input class="widefat" name="koki_' . esc_attr($key) . '" value="' . esc_attr(get_post_meta($post->ID, '_koki_' . $key, true)) . '" type="' . ($key === 'url' ? 'url' : 'text') . '"></label></p>';
        }
        echo '<p><label>表示順（小さい数から）<input type="number" name="koki_order" value="' . esc_attr($post->menu_order) . '"></label></p>';
    }, 'post');
});

add_action('save_post_post', function ($id) {
    if (!isset($_POST['koki_work_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['koki_work_nonce'])), 'koki_save_work') || !current_user_can('edit_post', $id) || wp_is_post_revision($id) || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)) return;
    foreach (['kind', 'role', 'note', 'url'] as $key) {
        $value = isset($_POST['koki_' . $key]) ? wp_unslash($_POST['koki_' . $key]) : '';
        update_post_meta($id, '_koki_' . $key, $key === 'url' ? esc_url_raw($value) : sanitize_text_field($value));
    }
});

add_filter('wp_insert_post_data', function ($data) {
    if ($data['post_type'] === 'post' && isset($_POST['koki_work_nonce'], $_POST['koki_order']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['koki_work_nonce'])), 'koki_save_work') && current_user_can('edit_posts')) {
        $data['menu_order'] = (int) $_POST['koki_order'];
    }
    return $data;
});

/* 外観 → カスタマイズ → ポートフォリオ設定 */
add_action('customize_register', function ($customizer) {
    $customizer->add_section('koki_portfolio', ['title' => 'ポートフォリオ設定']);
    $customizer->add_setting('koki_cf7_id', ['default' => '', 'sanitize_callback' => 'sanitize_text_field']);
    $customizer->add_control('koki_cf7_id', ['section' => 'koki_portfolio', 'label' => 'Contact Form 7のショートコードID', 'type' => 'text']);
});
