const mix = require('laravel-mix');

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
mix.setPublicPath('public');
mix.sass('resources/sass/main.scss', 'css/lib/style.css')
    .js('resources/js/app.js', 'js/app.js')
    .js('resources/js/components/_register.js', 'js/app.js')
    .js('resources/js/components/_nav.js', 'js/app.js')
    .js('resources/js/components/_offers.js', 'js/app.js')
    .js('resources/js/components/_news.js', 'js/app.js')
    .js('resources/js/components/_filter-by.js', 'js/app.js')
    .js('resources/js/components/_footer.js', 'js/app.js');