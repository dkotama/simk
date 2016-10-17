var elixir = require('laravel-elixir');

require('laravel-elixir-vueify')

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
    var npmDir = 'node_modules/',
        jsDir  = 'resources/assets/js',
        sassDir  = 'resources/assets/sass',
        cssDir  = 'resources/assets/css',
        publicCssDir  = 'public/css';
        publicJsDir  = 'public/js';
                
    mix.copy(npmDir + 'vue/dist/vue.min.js', jsDir);
    mix.copy(npmDir + 'vue-resource/dist/vue-resource.min.js', jsDir);
    mix.copy(npmDir + 'sweetalert/dist/sweetalert.min.js', jsDir);
    mix.copy(npmDir + 'sweetalert/dist/sweetalert.min.js', publicJsDir);
    
    mix.scripts([
        'vue.min.js',
        'vue-resource.min.js'
    ], 'public/js/vendor.js');

    // mix.copy(npmDir + 'sweetalert/dist/sweetalert.css', cssDir);
    // mix.copy(npmDir + 'sweetalert/dist/sweetalert.css', publicCssDir);
    // mix.sass('app.scss');    
});
