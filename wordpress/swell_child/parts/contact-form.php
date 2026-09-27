<?php
/**
 * Contact Form 7 が未設定のときに表示する確認用フォーム。送信はしない（JS で確認ダイアログを出すだけ）。
 */
defined('ABSPATH') || exit;
?>
<form class="contact__form" data-contact-form>
  <div class="contact__field">
    <label for="contact-name">
      お名前
      <span class="contact__required" aria-hidden="true">※</span>
    </label>
    <input class="contact__input" id="contact-name" type="text" name="name" autocomplete="name" placeholder="山田 太郎" required maxlength="100">
  </div>
  <div class="contact__field">
    <label for="contact-email">
      メールアドレス
      <span class="contact__required" aria-hidden="true">※</span>
    </label>
    <input class="contact__input" id="contact-email" name="email" type="email" autocomplete="email" placeholder="hello@example.com" required maxlength="254">
  </div>
  <div class="contact__field">
    <label for="contact-message">
      ご相談内容
      <span class="contact__required" aria-hidden="true">※</span>
    </label>
    <textarea class="contact__input contact__input--message" id="contact-message" name="message" placeholder="つくりたいもの、お困りのことなど。&#10;まだまとまっていなくても大丈夫です。" required maxlength="5000"></textarea>
  </div>
  <button class="button button--primary contact__submit" type="submit">
    入力内容を確認する
    <?php get_template_part('parts/icon-arrow'); ?>
  </button>
  <noscript>
    <p>入力内容の確認にはJavaScriptを有効にしてください。現在、送信機能は準備中です。</p>
  </noscript>
</form>
