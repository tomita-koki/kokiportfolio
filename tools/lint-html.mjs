// Local で表示中のトップの HTML を取得して html-validate にかける。
// 対象 URL は環境変数 LINT_URL で変えられる（既定: http://kokiportfolio.local/）。
import { execSync } from 'node:child_process';
import { mkdirSync, writeFileSync } from 'node:fs';

const url = process.env.LINT_URL ?? 'http://kokiportfolio.local/';
const response = await fetch(url);
if (!response.ok) {
  console.error(`${url} を取得できませんでした（${response.status}）。Local でサイトを起動してください。`);
  process.exit(1);
}
mkdirSync('.tmp', { recursive: true });
writeFileSync('.tmp/front.html', await response.text());
// WordPress 本体は属性をシングルクォートで囲み、<img /> のように出力する。
// HTML として正しく、テーマ側では変えられないので、その 2 ルールだけ外した設定で検査する。
try {
  execSync('npx html-validate --config tools/htmlvalidate.wordpress.json .tmp/front.html', { stdio: 'inherit' });
} catch {
  process.exit(1);
}
