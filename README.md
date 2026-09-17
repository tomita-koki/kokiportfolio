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
