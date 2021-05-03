const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js(
        'resources/js/app.js', 'public/js').vue({
        version: 2
    })
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .js([
        'resources/adminlte/plugins/jquery/jquery.js',
        'resources/adminlte/dist/js/adminlte.js'
    ], 'public/js/all.js')
    .styles([
        'resources/adminlte/dist/css/adminlte.min.css',
        'resources/adminlte/plugins/fontawesome-free/css/all.min.css'
    ], 'public/css/all.css');
