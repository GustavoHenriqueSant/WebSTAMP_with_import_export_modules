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
    mix.styles([
        './node_modules/handsontable/dist/handsontable.full.css',
    ], 'public/assets/css' /* <- caminho do arquivo de saida */);
});