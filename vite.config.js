import { defineConfig } from 'vite';
import { resolve } from 'node:path';

/**
 * WordPress 子テーマ用のビルド。HTML は wordpress/swell_child/*.php に直接書く。
 * CSS・JS をテーマの assets/ に出力し、functions.php が manifest.json から読み込む。
 */
export default defineConfig({
  root: 'src',
  base: './',
  publicDir: false,
  build: {
    outDir: resolve(__dirname, 'wordpress/swell_child/assets'),
    emptyOutDir: true,
    assetsDir: '',
    manifest: true,
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'src/scripts/main.js'),
        style: resolve(__dirname, 'src/styles/main.css'),
      },
    },
  },
});
