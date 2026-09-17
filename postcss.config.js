import postcssPresetEnv from 'postcss-preset-env';

export default {
  plugins: [
    // CSS Nesting などを browserslist に合わせて変換。autoprefixer を内包
    postcssPresetEnv({ stage: 2 }),
  ],
};
