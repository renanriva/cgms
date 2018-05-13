var mix = require('laravel-mix');

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

// @link https://github.com/JeffreyWay/laravel-mix/issues/819

/**
 *  ADMIN
 */
// .sass('resources/assets/sass/app.scss', 'public/admin/css/vendor.css')
// .sass('resources/assets/admin/sass/admin.scss', 'public/admin/css/app.css')

mix.autoload({
        jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery","window.jquery"]
    })
    .copy('node_modules/bootstrap-datepicker/dist/css/', 'public/admin/vendor/bootstrap-datepicker/dist/css')
    .sass('resources/assets/sass/app.scss', 'public/admin/css/app.css')
    .js([
        'public/vendor/adminlte/vendor/jquery/dist/jquery.js',
        'public/vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js',
        'public/vendor/adminlte/dist/js/adminlte.min.js',
        'node_modules/datatables/media/js/jquery.dataTables.js',
        'node_modules/select2/dist/js/select2.js',
        'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
        'public/vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js',

            'resources/assets/admin/js/ajax-setup.js',
            'resources/assets/admin/js/location.js',
            'resources/assets/admin/js/location/canton.js',
            'resources/assets/admin/js/location/parroquia.js',
            'resources/assets/admin/js/course.js',
            'resources/assets/admin/js/common.js'
        ],
        'public/admin/js/app.js')
    .options({
        processCssUrls: true
    })
    .version();
