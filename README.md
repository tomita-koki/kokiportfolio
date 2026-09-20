# LP / 小規模サイト テンプレート

Vite + 素の CSS（BEM）+ 素の JS（ES Modules）で LP・小規模サイトを作るための雛形。

## 使い方

1. このフォルダを `案件名/` としてコピーする（`node_modules` と `dist` は含めない）
2. `package.json` の `name` を案件名に変える
3. 依存をインストール

```bash
npm install
```

4. 開発サーバー起動（ブラウザが自動で開く）

```bash
npm run dev
```

5. 納品用ビルド → `dist/` に出力

```bash
npm run build
```

## コマンド

| コマンド | 内容 |
|---|---|
| `npm run dev` | 開発サーバー（HMR） |
| `npm run build` | `dist/` に本番ビルド |
| `npm run preview` | ビルド結果をローカルで確認 |
| `npm run lint:css` | Stylelint（BEM 命名チェック込み） |
| `npm run lint:html` | html-validate（`dist/` の HTML を検証） |
| `npm run lint` | CSS lint → build → HTML lint を通しで実行 |
| `npm run format` | Prettier で `src/` を整形 |

## ディレクトリ

```
src/
├─ index.html          # ページ。増やすときは vite.config.js の input と pageData にも追加
├─ partials/           # header.html / footer.html（{{> header}} で読み込み）
├─ styles/
│  ├─ main.css         # エントリ。global.css とブロックを @import
│  ├─ global.css       # :root トークン・リセット
│  └─ blocks/          # BEM ブロック 1 つにつき 1 ファイル
├─ scripts/
│  ├─ main.js          # エントリ。モジュールを import して init する
│  └─ modules/         # 機能単位（hamburger.js など）
└─ assets/img/         # HTML/CSS から参照する画像（ビルド時にハッシュ付与）
public/                # そのまま配信するもの（favicon, OGP 画像, robots.txt）
dist/                  # ビルド成果物 = 納品物
```

## ページを増やす

1. `src/about.html` を作る（`index.html` をコピー）
2. `vite.config.js` の `input` と `pageData` に追加

## 画像

- `src/assets/img/` に置き、HTML から `./assets/img/xxx.jpg` で参照する（ビルド時に最適なパスへ書き換わる）
- WebP / AVIF 化が必要なら `vite-imagetools` を追加する

## 納品前チェック

- `npm run lint` がエラー 0
- Chrome / Edge / Firefox / Safari で崩れなし
- SP（〜768px）/ TB（768〜1024px）/ PC（1024px〜）で横はみ出し・文字切れなし
- コンソールエラー 0

## このサイトの実装

- Figma: `fomSUpvIoM9FeQ2tqwHZ77`、PC `3:19`／SP `3:20`。
- 編集対象は `src/`、納品物は `npm run build` で生成する `dist/`。
- 制作実績はSwiperをnpmで同梱。768px以下は1件、769〜1024pxは2件、1025px以上は3件表示。
- メニュー、FAQ、FAQへの誘導リンク、400px以降の先頭へ戻るボタンを実装。
- お問い合わせは必須・メール形式チェックと確認ダイアログまで。送信処理は未接続。確認画面で未送信であることを表示する。
- Figma画像は `src/assets/img/` に保存。フォントはGoogle FontsのZen Kaku Gothic New。

## 公開前に必要な設定・差し替え

- ヘッダー・フッターのロゴ、プロフィール写真・表示名（カンプで支給待ちの状態を再現）。
- FAQの2〜5件目の回答は、カンプに回答本文がないため仮文。公開前に確認する。
- お問い合わせの送信先・送信処理、必要なプライバシー案内。
- 正式なOGP画像と公開URL、favicon（現状はテンプレート素材）。

## 検証範囲

- `npm run lint`：Stylelint、Vite build、html-validateすべて成功。
- Chrome・Edge：320 / 375 / 390 / 768 / 769 / 1024 / 1025 / 1440 / 1920pxで横はみ出し・画像読み込み失敗なし。
- メニュー開閉・Escape・ページ内リンク、制作実績の前後移動、FAQ開閉、入力必須チェック、確認画面・Escape、先頭へ戻るを確認。コンソールエラー0。
- Firefox、Safari、iOS実機は未確認。
