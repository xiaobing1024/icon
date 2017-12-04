let mix = require('laravel-mix');


mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

/**
 * 发布时文件名打上 hash 以强制客户端更新
 */
if (mix.inProduction()) {
    mix.version()
}