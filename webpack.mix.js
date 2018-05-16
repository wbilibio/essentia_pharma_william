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

mix.copyDirectory('resources/assets/images', 'public/images')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.scripts([
    'resources/assets/libs/jquery/dist/jquery.min.js',
    'resources/assets/libs/jquery-ui/jquery-ui.min.js',
    'resources/assets/libs/bootstrap/dist/js/bootstrap.min.js',
    'resources/assets/libs/bootstrap-sweetalert/lib/sweet-alert.js',
    'resources/assets/libs/jquery.maskedinput/dist/jquery.maskedinput.min.js',
    'resources/assets/js/main.js'
], 'public/js/main.js');
