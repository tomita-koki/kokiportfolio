import { defineConfig } from 'vite';
import { resolve } from 'node:path';
import handlebars from 'vite-plugin-handlebars';

/** ページごとに差し込む値。ページを増やしたら input と pageData の両方に追加する */
const pageData = {
  '/index.html': {
    title: 'とこ | 話すことから、はじまるWeb制作。',
    description: '個人で活動するあなたの、Web制作の相談相手。想いや困りごとを一緒に整理し、デザインからコーディング、WordPress、公開後の更新までひとつの窓口でお手伝いします。',
  },
};

export default defineConfig({
  root: 'src',
  publicDir: '../public',
  base: './', // 相対パス納品（サブディレクトリ設置でも壊れない）
  build: {
    outDir: '../dist',
    emptyOutDir: true,
    rollupOptions: {
      input: {
        index: resolve(__dirname, 'src/index.html'),
        // about: resolve(__dirname, 'src/about.html'),
      },
    },
  },
  plugins: [
    handlebars({
      partialDirectory: resolve(__dirname, 'src/partials'),
      context(pagePath) {
        return pageData[pagePath] ?? {};
      },
    }),
  ],
  server: {
    open: true,
  },
});
