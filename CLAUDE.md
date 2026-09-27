# kokiportfolio（ポートフォリオサイト）

SWELL の子テーマとして WordPress で運用するポートフォリオサイト。共通ルールは `work/coding/CLAUDE.md` と `web-coding` スキルに従う。
（`feature/WordPress` ブランチの構成。静的 HTML 版は `develop` など他のブランチに残っている）

## この案件の構成

- テーマ: `wordpress/swell_child/`（親テーマ SWELL 2.19.0）。トップ（`front-page.php`）だけ独自の HTML・CSS・JS で描画し、他のページは SWELL の表示を使う
  - トップの HTML は `header-front.php` / `front-page.php` / `footer-front.php` に直接書く。`header.php` / `footer.php` は置かない（置くと他ページの SWELL のヘッダー・フッターが置き換わる）
  - 共通パーツは `parts/*.php` を `get_template_part()` で読み込む（矢印アイコンは `parts/icon-arrow.php`、向きは `['modifier' => 'down']` 等で渡す）
  - 画像は `wordpress/swell_child/img/`。トップの title / description は `functions.php` の `koki_front_title()` / `koki_front_description()`
- 制作実績: 標準投稿のカテゴリー「制作実績」（スラッグ `works`）。種別・担当範囲・補足文・リンク先・表示順は投稿編集画面の「制作実績の表示内容」で入力し、アイキャッチを設定する
- お問い合わせ: 外観 → カスタマイズ → ポートフォリオ設定に Contact Form 7 のショートコード ID を入れると CF7 を表示。未設定なら送信しない確認用フォーム（`parts/contact-form.php`）
- CSS: `src/styles/main.css`（エントリ）→ `global.css`（トークン・リセット）+ `blocks/*.css`（BEM ブロック 1 つ = 1 ファイル）。ブロック追加時は `main.css` に `@import` を足す。Sass は使わない
- JS: `src/scripts/main.js` から `modules/*.js` を import。DOM 取得は `data-*` 属性
- ビルド: `npm run build` で CSS・JS を `wordpress/swell_child/assets/` に出力（git 管理外）。`functions.php` が `assets/.vite/manifest.json` から読み込む。`npm run dev` は保存のたびに再ビルドする（`vite build --watch`）
- トップでは親テーマ SWELL の CSS・JS を `functions.php` の `koki_dequeue_parent_assets()` でまとめて外している

## ローカル環境（Local）

- サイト: `kokiportfolio`（http://kokiportfolio.local/ 、WordPress 7.1.2 / PHP 8.2.29）。Local アプリでサイトを起動してから作業する
- 子テーマは `C:\Users\tomit\Local Sites\kokiportfolio\app\public\wp-content\themes\swell_child` からこのリポジトリの `wordpress/swell_child` へジャンクションでつないである。PHP を保存すればそのまま反映される
- WP-CLI（Local 同梱）:
  `"%APPDATA%\Local\lightning-services\php-8.2.29+0\bin\win64\php.exe" -d display_startup_errors=0 -c "%APPDATA%\Local\run\tLiGjRgNG\conf\php\php.ini" "%LOCALAPPDATA%\Programs\Local\resources\extraResources\bin\wp-cli\wp-cli.phar" --path="%USERPROFILE%\Local Sites\kokiportfolio\app\public" <コマンド>`
- URL のクエリに `?w=` を使わない（WordPress が「週」の指定と解釈して 404 になる）

## 品質ゲート

`npm run lint`（Stylelint → build → html-validate）をエラー 0 にしてから納品する。
`npm run lint:html` は Local で表示中のトップ（既定 http://kokiportfolio.local/ 、環境変数 `LINT_URL` で変更可）を取得して検査する。WordPress 本体の出力に合わせ、`attr-quotes` と `void-style` だけ外した `tools/htmlvalidate.wordpress.json` を使う。

## デプロイ

`npm run build` のあと `wordpress/swell_child` を ZIP にし、外観 → テーマ → テーマのアップロードで「アップロードしたもので置き換える」。テスト環境は https://demo.kokiportfolio.com/ （Basic 認証あり。管理画面の操作は Chrome で行う）。本番反映前にバックアップを取る。

## 案件固有のメモ

- （デザインカンプの場所、指定フォント、ブレークポイントの変更などをここに書く）
