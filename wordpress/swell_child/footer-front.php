<?php
/**
 * トップページ専用のフッター。front-page.php から get_footer('front') で読み込む。
 */
defined('ABSPATH') || exit;
$koki_img = get_stylesheet_directory_uri() . '/img';
?>
    <footer class="footer">
      <div class="footer__inner">
        <div class="footer__row">
          <a class="logo" href="#top" aria-label="とこ ホーム"><img class="logo__image" src="<?php echo esc_url($koki_img . '/logo.svg'); ?>" alt="" width="40" height="40" loading="lazy" decoding="async"></a>
          <p class="footer__tagline">話を聞いて、一緒につくるWebサイト。</p>
        </div>
        <small class="footer__copyright">© とこ</small>
      </div>
    </footer>
    <a class="button button--primary button--round back-top" href="#top" aria-label="ページの先頭へ戻る" data-back-top>
      <?php get_template_part('parts/icon-arrow', null, ['modifier' => 'up']); ?>
    </a>
    <dialog class="confirmation" data-confirmation aria-labelledby="confirmation-title">
      <h2 class="confirmation__title" id="confirmation-title">入力内容の確認</h2>
      <dl class="confirmation__list">
        <dt>お名前</dt>
        <dd class="confirmation__value" data-confirm-name></dd>
        <dt>メールアドレス</dt>
        <dd class="confirmation__value" data-confirm-email></dd>
        <dt>ご相談内容</dt>
        <dd class="confirmation__value" data-confirm-message></dd>
      </dl>
      <p class="confirmation__notice">
        お問い合わせの送信機能は準備中です。入力内容はまだ送信されていません。
      </p>
      <button class="button button--primary" type="button" data-confirm-close>入力に戻る</button>
    </dialog>
    <?php wp_footer(); ?>
  </body>
</html>
