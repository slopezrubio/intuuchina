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
    .js([
        'resources/js/bootstrap.js',
    ], 'js/vendor.js')
    .js([
        'resources/js/pages/home.js',
        'resources/js/pages/job-description.js',
        'resources/js/pages/welcome.js',
        'resources/js/pages/admin/show-offer.js',
        'resources/js/pages/admin/new-offer.js',
        'resources/js/pages/admin/dashboard.js',
        'resources/js/pages/user/payment.js',
        'resources/js/components/sliders.js',
        'resources/js/components/register.js',
        'resources/js/components/_nav.js',
        'resources/js/components/_page-title.js',
        'resources/js/components/_offers.js',
        'resources/js/components/_offers-list.js',
        'resources/js/components/_single-offer.js',
        'resources/js/components/_edit-offer.js',
        'resources/js/components/_news.js',
        'resources/js/components/_services.js',
        'resources/js/components/_customer-journey.js',
        'resources/js/components/_welcome-card.js',
        'resources/js/components/_filter-by.js',
        'resources/js/components/_stats.js',
        'resources/js/components/_motifs.js',
        'resources/js/components/_footer.js',
    ], 'js/app.js');


    /*.js('resources/js/app.js', 'js/app.js')
    .js('resources/js/components/sliders.js', 'js/app.js')
    .js('resources/js/components/_register.js', 'js/app.js')
    .js('resources/js/components/_nav.js', 'js/app.js')
    .js('resources/js/components/_page-title.js', 'js/app.js')
    .js('resources/js/components/_offers.js', 'js/app.js')
    .js('resources/js/components/_offers-list.js', 'js/app.js')
    .js('resources/js/components/_single-offer.js', 'js/app.js')
    .js('resources/js/components/_edit-offer.js', 'js/app.js')
    .js('resources/js/components/_news.js', 'js/app.js')
    .js('resources/js/components/_services.js', 'js/app.js')
    .js('resources/js/components/_chinese-courses.js', 'js/app.js')
    .js('resources/js/components/_customer-journey.js', 'js/app.js')
    .js('resources/js/components/_filter-by.js', 'js/app.js')
    .js('resources/js/components/_stats.js', 'js/app.js')
    .js('resources/js/components/_motifs.js', 'js/app.js')
    .js('resources/js/components/_footer.js', 'js/app.js');*/
