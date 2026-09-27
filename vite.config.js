import { defineConfig } from 'vite';
import { resolve } from 'node:path';
import handlebars from 'vite-plugin-handlebars';

/**
 * ページごとに差し込む値。ページを増やしたら input と pageData の両方に追加する。
 * index.html の title / description は HTML に直接書いてあるのでここには置かない。
 */
const pageData = {};

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
