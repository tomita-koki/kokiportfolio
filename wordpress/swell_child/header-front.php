<?php
/**
 * トップページ専用のヘッダー。front-page.php から get_header('front') で読み込む。
 * 他のページは SWELL の header.php を使うので、header.php は置かない。
 */
defined('ABSPATH') || exit;
$koki_img = get_stylesheet_directory_uri() . '/img';
$koki_title = koki_front_title();
$koki_description = koki_front_description();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
      document.documentElement.classList.add('loading-active');
      // If the module or a resource fails, always return control to the visitor.
      window.setTimeout(() => {
        document.dispatchEvent(new Event('loading-timeout'));
        document.documentElement.classList.remove('loading-active');
        document.querySelector('[data-loading]')?.remove();
      }, 12000);
    </script>
    <meta name="description" content="<?php echo esc_attr($koki_description); ?>">
    <meta property="og:title" content="<?php echo esc_attr($koki_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($koki_description); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta property="og:site_name" content="とこ">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:image" content="<?php echo esc_url(get_stylesheet_directory_uri() . '/ogp.png'); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="とこ 話すことから、はじまるWeb制作。">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="<?php echo esc_url(get_stylesheet_directory_uri() . '/favicon.svg'); ?>" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class('koki-front'); ?>>
    <?php wp_body_open(); ?>
    <div class="loading" data-loading>
      <progress class="loading__accessible" data-loading-accessible max="100" value="0" aria-label="ページを読み込んでいます"></progress>
      <svg class="loading__surface" data-loading-surface xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
        <defs>
          <mask id="loading-aperture" maskUnits="userSpaceOnUse" x="0" y="0" width="100%" height="100%">
            <rect width="100%" height="100%" fill="white"></rect>
            <circle data-loading-hole cx="0" cy="0" r="0" fill="black"></circle>
          </mask>
        </defs>
        <rect width="100%" height="100%" fill="white" mask="url(#loading-aperture)"></rect>
        <circle class="loading__track" data-loading-ring cx="50%" cy="50%" r="56" fill="none" stroke-width="3"></circle>
        <circle class="loading__progress" data-loading-ring data-loading-progress cx="50%" cy="50%" r="56" fill="none" stroke-width="3" stroke-dasharray="351.859" stroke-dashoffset="351.859"></circle>
      </svg>
      <div class="loading__label" data-loading-label aria-hidden="true">
        <span class="loading__value" data-loading-value>0%</span>
        <span>Loading…</span>
      </div>
    </div>
    <a class="skip-link" href="#main">本文へ移動</a>
    <header class="header">
      <div class="header__overlay" data-nav-overlay></div>
      <div class="header__inner">
        <a class="logo" href="#top" aria-label="とこ ホーム"><img class="logo__image" src="<?php echo esc_url($koki_img . '/logo.svg'); ?>" alt="" width="40" height="40"></a>
        <button class="header__toggle" type="button" aria-label="メニューを開く" aria-expanded="false" aria-controls="navigation" data-nav-toggle>
          <span class="header__line"></span>
          <span class="header__line"></span>
          <span class="header__line"></span>
        </button>
        <nav class="header__nav" id="navigation" aria-label="メインナビゲーション" data-nav>
          <a class="header__link" href="#service">SERVICE</a>
          <a class="header__link" href="#works">WORKS</a>
          <a class="header__link" href="#about">ABOUT</a>
          <a class="header__link" href="#faq">FAQ</a>
          <a class="button button--primary" href="#contact">
            CONTACT
            <?php get_template_part('parts/icon-arrow'); ?>
          </a>
        </nav>
      </div>
    </header>
