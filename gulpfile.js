var elixir = require('laravel-elixir');


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('style.scss', './public/css/style.css');
    mix.browserify('index.js', './public/js/app.js');
    mix.copy('./resources/assets/images', './public/images');
    mix.copy('./resources/assets/files', './public/files');
    /*mix.scripts([
    	'./public/js/app.js',
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/fancybox/dist/js/jquery.fancybox.js'
    	], './public/js/app.js');
    mix.styles([
        './public/css/style.css',
        './node_modules/fancybox/dist/css/jquery.fancybox.css',
    ], './public/css/style.css');*/
});