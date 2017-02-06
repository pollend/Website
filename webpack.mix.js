const { mix } = require('laravel-mix');

// mix.sass(['app.scss', 'wiki.scss'], 'public/css/app.css');
//
// // mix.scripts(['*.js'], 'public/js/app.js');
//
// mix
//
// mix.copy(
//     'resources/assets/libs/bootstrap-sass/assets/fonts',
//     'public/build/fonts'
// );
//
// mix.copy("node_modules/bootstrap-sass/assets/fonts","public/build/fonts");
//


mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/wiki.scss', 'public/css')
    .version([
        'css/app.css',
        'css/wiki.css',
        'js/app.js'
    ]);
    // .copy("node_modules/bootstrap-sass/assets/fonts","public/build/fonts")
    // .copy(
    //     'resources/assets/libs/bootstrap-sass/assets/fonts',
    //     'public/build/fonts'
    // );