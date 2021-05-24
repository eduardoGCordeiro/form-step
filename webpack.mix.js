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

mix.scripts('node_modules/jquery/dist/jquery.min.js', 'public/js/jquery.js');
mix.scripts('node_modules/jquery-mask-plugin/dist/jquery.mask.min.js', 'public/js/jquery-mask.js');
mix.scripts('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js/bootstrap.js');
mix.scripts('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css/bootstrap.css');
mix.scripts('node_modules/sweetalert2/dist/sweetalert2.all.min.js', 'public/js/sweetalert2.js');
mix.scripts('node_modules/sweetalert2/dist/sweetalert2.min.css', 'public/css/sweetalert2.css');
mix.copyDirectory('node_modules/font-awesome', 'public/css/font-awesome');
