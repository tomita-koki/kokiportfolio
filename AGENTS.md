# kokiportfolio（ポートフォリオサイト）

Vite ベースの LP / 小規模サイト。共通ルールは `../../coding/AGENTS.md`（作業前に読む） と `web-coding` スキルに従う。

## この案件の構成

- 開発: `npm run dev` / ビルド: `npm run build`（`dist/` が納品物）
- HTML: `src/*.html`。共通パーツは `src/partials/` を `{{> name}}` で読み込む
- CSS: `src/styles/main.css`（エントリ）→ `global.css`（トークン・リセット）+ `blocks/*.css`（BEM ブロック 1 つ = 1 ファイル）。ブロック追加時は `main.css` に `@import` を足す。Sass は使わない
- JS: `src/scripts/main.js` から `modules/*.js` を import。DOM 取得は `data-*` 属性
- ページ追加時は `vite.config.js` の `input` と `pageData` に登録する

## 品質ゲート

`npm run lint`（Stylelint → build → html-validate）をエラー 0 にしてから納品する。

## 案件固有のメモ

- （デザインカンプの場所、指定フォント、ブレークポイントの変更などをここに書く）

