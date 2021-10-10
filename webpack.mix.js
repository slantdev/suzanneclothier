let mix = require('laravel-mix');
let path = require('path');

mix.setPublicPath(path.resolve('./'));

mix.js('resources/js/app.js', './assets/js');

mix.postCss("resources/css/app.css", "./assets/css");
mix.postCss("resources/css/editor-style.css", "./assets/css");

mix.options({
  postCss: [
    require('postcss-nested-ancestors'),
    require('postcss-nested'),
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
  ]
});

mix.browserSync({
  proxy: 'http://suzanneclothier.local',
  host: 'suzanneclothier.local',
  open: 'external',
  port: 8000
});

// mix.webpackConfig({
//   stats: {
//     hash: true,
//     version: true,
//     timings: true,
//     children: true,
//     errors: true,
//     errorDetails: true,
//     warnings: true,
//     chunks: true,
//     modules: false,
//     reasons: true,
//     source: true,
//     publicPath: true,
//   }
// });

mix.version();
