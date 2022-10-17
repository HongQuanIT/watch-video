const mix = require('laravel-mix');
var path = require('path');

// resolve: {
//     root: path.resolve('./mydir'),
//     extensions: ['', '.js']
//   }

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
mix.webpackConfig({
    resolve: {
        modules: [
            path.resolve(__dirname, 'resources/js'), "node_modules"
        ]
    }
});

mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
