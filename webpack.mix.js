let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/head.js', 'public/build/js')
    .js('resources/js/foot.js', 'public/build/js')
    .sass('resources/sass/app.scss', 'public/build/css')
    .version()
;
