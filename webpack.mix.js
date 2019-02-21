let mix = require('laravel-mix');


// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css')
//     .scripts([
//         'public/js/app.js',
//         'resources/assets/js/jquery-labelauty.js',
//         'resources/assets/js/dropify.js'
//     ], 'public/js/all.js')
//     .styles([
//         'public/css/app.css',
//         'resources/assets/sass/jquery-labelauty.css',
//         'resources/assets/sass/dropify.css'
//     ], 'public/css/all.css')
//     .copy('resources/images/input-checked.png', 'public/image/input-checked.png')
//     .copy('resources/images/input-unchecked.png', 'public/image/input-unchecked.png')
//     .copy('resources/fonts/dropify.eot', 'public/fonts/dropify.eot')
//     .copy('resources/fonts/dropify.svg', 'public/fonts/dropify.svg')
//     .copy('resources/fonts/dropify.ttf', 'public/fonts/dropify.ttf')
//     .copy('resources/fonts/dropify.woff', 'public/fonts/dropify.woff');

/**
 * 发布时文件名打上 hash 以强制客户端更新
 */
// if (mix.inProduction()) {
//     mix.version()
// }

mix.scripts([
        'public/js/jquery.min.js',
        'public/js/fastclick.min.js',
        'public/js/jquery-weui.min.js',
        'public/js/clipboard.min.js',
        'public/js/collect.min.js',
        'public/js/vue.min.js',
        'public/js/swiper.min.js',
    ], 'public/js/cpall.js')
    .styles([
        'public/css/weui.min.css',
        'public/css/jquery-weui.min.css',
        'public/css/swiper.min.css'
    ], 'public/css/cpall.css');