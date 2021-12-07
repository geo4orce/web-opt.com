let mix = require('laravel-mix');

mix
    .js('resources/js/head.js', 'public/build/js')
    .js('resources/js/foot.js', 'public/build/js')
    .sass('resources/sass/app.scss', 'public/build/css')
    .version()
;
