<?php
/**
 * トップページ。設定 → 表示設定で「ホームページ」に指定した固定ページで使われる。
 */
defined('ABSPATH') || exit;
$koki_img = get_stylesheet_directory_uri() . '/img';
$koki_works = koki_get_works();
$koki_works_total = $koki_works->post_count + 1; // 非公開案件のカードを含む
get_header('front');
?>
    <main id="main">
      <section class="hero" id="top" data-hero aria-labelledby="hero-title">
        <div class="hero__shapes" data-hero-background aria-hidden="true">
          <span class="hero__shape hero__shape--0"></span>
          <span class="hero__shape hero__shape--1"></span>
          <span class="hero__shape hero__shape--2"></span>
        </div>
        <div class="hero__inner">
          <div class="hero__copy">
            <p class="hero__eyebrow" data-hero-enter>個人で活動するあなたの、Web制作の相談相手。</p>
            <h1 class="hero__title" id="hero-title" data-hero-enter>
              <span class="text-line">話すことから、</span>
              <span>はじまるWeb制作。</span>
            </h1>
            <p class="hero__lead" data-hero-enter>
              <span class="text-line">
                「何から始めればいい？」も、聞かせてください。
              </span>
              <span class="text-line">
                あなたの想いや困りごとを、一緒に整理。
              </span>
              <span class="text-line">
                デザインから公開後の更新まで、ひとつの窓口で。
              </span>
            </p>
            <a class="button button--primary" href="#contact" data-hero-enter>
              つくりたいことを相談する
              <?php get_template_part('parts/icon-arrow'); ?>
            </a>
            <p class="hero__note" data-hero-enter>ご希望がまとまっていなくても、大丈夫です。</p>
          </div>
          <div class="hero__visual">
            <p class="hero__visual-title">想いを聞いて、ひとつずつ形に。</p>
            <img src="<?php echo esc_url($koki_img . '/works/img-work-01.png'); ?>" alt="世界史制服のWebサイト" width="800" height="500" class="hero__image" data-hero-background fetchpriority="high">
            <p class="hero__caption">世界史制服 様</p>
            <p class="hero__category">コーディング・WordPress</p>
            <div class="hero__message-area">
              <p class="hero__message">話を聞く</p>
              <p class="hero__message">一緒に考える</p>
              <p class="hero__message">丁寧につくる</p>
            </div>
          </div>
        </div>
      </section>
      <div class="consultation reveal" data-reveal>
        <div class="consultation__inner">
          <p class="consultation__title">相談する前の「分からない」を、<br>
            少しずつ。</p>
          <div class="consultation__link-area">
            <a class="consultation__link" href="#faq-cost" data-faq-link>
              いくらかかる？
              <?php get_template_part('parts/icon-arrow', null, ['modifier' => 'down']); ?>
            </a>
            <a class="consultation__link" href="#faq-prepare" data-faq-link>
              何を用意する？
              <?php get_template_part('parts/icon-arrow', null, ['modifier' => 'down']); ?>
            </a>
            <a class="consultation__link" href="#service">
              どこまで頼める？
              <?php get_template_part('parts/icon-arrow', null, ['modifier' => 'down']); ?>
            </a>
          </div>
        </div>
      </div>
      <section class="section service reveal" data-reveal id="service" aria-labelledby="service-title">
        <div class="section__inner service__inner">
          <div class="section__heading">
            <p class="section__eyebrow">01 / SERVICE</p>
            <h2 class="section__title" id="service-title">
              <span>サービスフロー</span>
            </h2>
          </div>
          <p class="service__intro">
            つくって終わりではなく、<span class="mobile-break">使い続けられるサイトへ。</span><span class="mobile-break">5つのステップでお手伝いします。</span>
          </p>
          <ol class="service__steps">
            <li class="service__step">
              <h3 class="service__name">
                <span class="service__number">01</span>
                ヒアリング
              </h3>
              <div class="service__detail">
                <p class="service__lead">つくりたいことを、一緒に整理。</p>
                <p class="service__text">
                  活動のこと、ご希望、お困りごとを伺います。必要なページや作業を整理し、費用とスケジュールをご案内します。
                </p>
              </div>
            </li>
            <li class="service__step">
              <h3 class="service__name">
                <span class="service__number">02</span>
                デザイン
              </h3>
              <div class="service__detail">
                <p class="service__lead">あなたらしい、伝わる見せ方に。</p>
                <p class="service__text">
                  内容の構成からデザインの制作・手配まで。必要な文章や写真をご案内し、見た目と使いやすさを一緒に確かめます。
                </p>
              </div>
            </li>
            <li class="service__step">
              <h3 class="service__name">
                <span class="service__number">03</span>
                設計・実装
              </h3>
              <div class="service__detail">
                <p class="service__lead">見やすく、使いやすく、動く形へ。</p>
                <p class="service__text">
                  PC・スマートフォンでの表示を整え、コーディングやWordPressへの組み込みを行います。画面をご確認いただきながら進めます。
                </p>
              </div>
            </li>
            <li class="service__step">
              <h3 class="service__name">
                <span class="service__number">04</span>
                公開
              </h3>
              <div class="service__detail">
                <p class="service__lead">確認を重ねて、公開へ。</p>
                <p class="service__text">
                  表示や動作を確認し、契約済みのサーバー・ドメインへの公開に対応します。
                </p>
              </div>
            </li>
            <li class="service__step">
              <h3 class="service__name">
                <span class="service__number">05</span>
                運用・改善
              </h3>
              <div class="service__detail">
                <p class="service__lead">つくったあとも、相談できる。</p>
                <p class="service__text">
                  文章・画像の更新、WordPressの保守、ページの修正・追加まで。活動の変化に合わせて、必要なお手伝いをご相談いただけます。
                </p>
              </div>
            </li>
          </ol>
          <p class="service__note">
            一件ずつ丁寧に対応します。公開後の対応範囲・費用・期間も、ご希望に合わせてお見積もりします。
          </p>
          <aside class="service__director" aria-label="制作会社・ディレクターの方へ">
            <p>
              <span class="text-line">ディレクターの方へ</span>
              コーディングのみのご依頼も承ります。1ページ単位・既存サイトの修正など、部分的なご相談も歓迎です。
            </p>
            <a class="button button--primary" href="#contact">
              実装について相談する
              <?php get_template_part('parts/icon-arrow'); ?>
            </a>
          </aside>
        </div>
      </section>
      <section class="section works reveal" data-reveal id="works" aria-labelledby="works-title">
        <div class="section__inner works__inner">
          <div class="section__heading">
            <p class="section__eyebrow">02 / WORKS</p>
            <h2 class="section__title" id="works-title">制作実績</h2>
          </div>
          <p class="works__intro">
            <span class="text-line">実案件と自主制作をご紹介します。</span>
            それぞれの担当範囲も、併せてご覧ください。
          </p>
          <div class="swiper works__slider" data-works>
            <div class="swiper-wrapper">
              <?php get_template_part('parts/works', null, ['query' => $koki_works]); ?>
              <article class="swiper-slide works__card">
                <div class="works__nda">
                  <div class="works__lock" aria-hidden="true">
                    <svg class="works__lock-icon" viewBox="0 0 24 24" fill="none" focusable="false">
                      <rect x="4" y="11" width="16" height="10" rx="2" stroke="currentColor" stroke-width="1.5"></rect>
                      <path d="M8 11V7a4 4 0 018 0v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                    <p class="works__lock-label">CONFIDENTIAL</p>
                  </div>
                  <div class="works__caption">
                    <p class="works__category">実案件・非公開</p>
                    <h3 class="works__title">非公開案件（2件）</h3>
                    <p class="works__description">守秘義務（NDA）のため詳細は非公開。お打ち合わせの際に可能な範囲でご紹介します</p>
                  </div>
                </div>
              </article>
            </div>
          </div>
          <div class="works__controls">
            <p class="works__count" data-works-count aria-live="polite">01 / <?php echo esc_html(sprintf('%02d', $koki_works_total)); ?></p>
            <div class="works__arrows">
              <button class="button button--primary button--round" type="button" aria-label="前の制作実績" data-works-prev>
                <?php get_template_part('parts/icon-arrow', null, ['modifier' => 'reverse']); ?>
              </button>
              <button class="button button--primary button--round" type="button" aria-label="次の制作実績" data-works-next>
                <?php get_template_part('parts/icon-arrow'); ?>
              </button>
            </div>
          </div>
        </div>
      </section>
      <section class="section about reveal" data-reveal id="about" aria-labelledby="about-title">
        <div class="section__inner about__inner">
          <p class="section__eyebrow">03 / ABOUT</p>
          <div class="about__profile">
            <div class="about__portrait">
              <img src="<?php echo esc_url($koki_img . '/profile.webp'); ?>" alt="とこのプロフィール写真" width="802" height="720" loading="lazy" decoding="async">
            </div>
            <div class="about__bio">
              <p class="section__eyebrow">TOKYO, JAPAN</p>
              <h2 class="section__title" id="about-title">
                はじめまして。
              </h2>
              <p>
                <span class="text-line">東京都を拠点にWeb制作をしています。</span>
                <span class="text-line">大切にしているのは、話を聞いて、</span>
                <span class="text-line">一つひとつ確かめながらつくること。</span>
              </p>
            </div>
          </div>
          <div class="about__values">
            <h3 class="section__title-2">
              <span class="text-line">気軽に話せる。</span>
              仕事は、きちんと。
            </h3>
            <ol class="about__strengths">
              <li class="about__strength">
                <h4 class="about__strength-title">
                  <span class="about__number">01</span>
                  話を聞き、整理する。
                </h4>
                <p class="about__text">
                  依頼内容がまとまっていなくても大丈夫。ご希望や不安を伺い、決める必要があることを一緒に整理します。
                </p>
              </li>
              <li class="about__strength">
                <h4 class="about__strength-title">
                  <span class="about__number">02</span>
                  先回りして、確認する。
                </h4>
                <p class="about__text">
                  作り始める前に、曖昧な点を洗い出します。担当範囲外でも、気になることがあればお伝えします。
                </p>
              </li>
              <li class="about__strength">
                <h4 class="about__strength-title">
                  <span class="about__number">03</span>
                  分かる形で、説明する。
                </h4>
                <p class="about__text">
                  言葉だけでは伝わりにくい動きは、実際に動くサンプルで。見て、確かめていただける説明を心がけています。
                </p>
              </li>
            </ol>
          </div>
        </div>
      </section>
      <section class="section faq reveal" data-reveal id="faq" aria-labelledby="faq-title">
        <div class="section__inner faq__inner">
          <div class="section__heading">
            <p class="section__eyebrow">04 / FAQ</p>
            <h2 class="section__title" id="faq-title">相談の、その前に。</h2>
          </div>
          <div class="faq__list" data-faq>
            <details class="faq__item" id="faq-cost" open>
              <summary class="faq__question">
                <span class="faq__mark" aria-hidden="true">Q</span>
                <span>費用はどのように決まりますか？</span>
                <span class="faq__icon" aria-hidden="true"></span>
              </summary>
              <p class="faq__answer">
                ご希望の内容、ページ数、デザインや機能の範囲を伺って個別にお見積もりします。作業範囲と費用をご確認いただいてから着手します。ページの追加や当初の範囲を超える変更も、事前に費用をご案内します。
              </p>
            </details>
            <details class="faq__item" id="faq-support">
              <summary class="faq__question">
                <span class="faq__mark" aria-hidden="true">Q</span>
                <span>公開後も相談できますか？</span>
                <span class="faq__icon" aria-hidden="true"></span>
              </summary>
              <p class="faq__answer">
                はい。文章・画像の更新、WordPressの保守、ページの修正・追加などをご相談いただけます。対応範囲・費用・期間は、ご希望に合わせてお見積もりします。
              </p>
            </details>
            <details class="faq__item" id="faq-prepare">
              <summary class="faq__question">
                <span class="faq__mark" aria-hidden="true">Q</span>
                <span>何を用意してから相談すればよいですか？</span>
                <span class="faq__icon" aria-hidden="true"></span>
              </summary>
              <p class="faq__answer">
                最初は何も用意しなくて大丈夫です。サイトに載せる文章や写真はお客様にご用意いただいていますが、準備が難しい場合もご相談ください。お話を伺いながら、一緒に考えます。
              </p>
            </details>
            <details class="faq__item" id="faq-schedule">
              <summary class="faq__question">
                <span class="faq__mark" aria-hidden="true">Q</span>
                <span>予算や納期が決まっていなくても大丈夫ですか？</span>
                <span class="faq__icon" aria-hidden="true"></span>
              </summary>
              <p class="faq__answer">
                はい。ご希望がまとまっていなくても大丈夫です。必要なページや作業を一緒に整理し、費用とスケジュールをご案内します。
              </p>
            </details>
            <details class="faq__item" id="faq-scope">
              <summary class="faq__question">
                <span class="faq__mark" aria-hidden="true">Q</span>
                <span>対応していない作業はありますか？</span>
                <span class="faq__icon" aria-hidden="true"></span>
              </summary>
              <p class="faq__answer">
                必要な作業を伺ったうえで、対応できる範囲をご案内します。まずはご希望の内容をお聞かせください。
              </p>
            </details>
          </div>
        </div>
      </section>
      <section class="section contact reveal" data-reveal id="contact" aria-labelledby="contact-title">
        <div class="section__inner contact__inner">
          <div class="contact__copy">
            <div class="section__heading">
              <p class="section__eyebrow contact__eyebrow">LET’S TALK</p>
              <h2 class="section__title" id="contact-title">
                <span class="text-line">その「つくりたい」、</span>
                聞かせてください。
              </h2>
            </div>
            <p>
              <span class="text-line">まだまとまっていなくても大丈夫。</span>
              小さな疑問から、お気軽にどうぞ。
            </p>
            <p class="contact__note">
              <span class="text-line">内容を伺って、個別にお見積もりします。</span>
              作業範囲と費用を確認してから、制作を始めます。
            </p>
          </div>
          <?php koki_the_contact_form(); ?>
        </div>
        <svg class="contact__waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none" aria-hidden="true" focusable="false">
          <defs>
            <!-- One period is 1440 units; three periods cover every animation phase. -->
            <path id="contact-wave" d="M-1440 40 Q-1080 0 -720 40 T0 40 T720 40 T1440 40 T2160 40 T2880 40 V100 H-1440 Z"></path>
          </defs>
          <use class="contact__wave contact__wave--back" href="#contact-wave" y="0" fill="white" fill-opacity="0.7"></use>
          <use class="contact__wave contact__wave--middle" href="#contact-wave" y="3" fill="white" fill-opacity="0.5"></use>
          <use class="contact__wave contact__wave--near" href="#contact-wave" y="5" fill="white" fill-opacity="0.3"></use>
          <use class="contact__wave contact__wave--front" href="#contact-wave" y="7" fill="white" fill-opacity="1"></use>
        </svg>
      </section>
    </main>
<?php
get_footer('front');
