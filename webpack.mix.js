const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

/** JS **/
mix.js('resources/js/app.js', 'public/js')
    .vue()
    .version();

/** CSS **/
mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('postcss-nested'),
    tailwindcss('./tailwind.config.js'),
    require('autoprefixer')
]).version();

mix.css('resources/css/tinymce/content.css', 'public/vendor/tinymce/skins/grm/content.min.css');
mix.css('resources/css/tinymce/skin.css', 'public/vendor/tinymce/skins/grm/skin.min.css');

/** Babel **/
mix.babelConfig({
    plugins: ['@babel/plugin-syntax-dynamic-import'],
});


/** Webpack **/
const config = require('./webpack.config')
mix.webpackConfig(config);
