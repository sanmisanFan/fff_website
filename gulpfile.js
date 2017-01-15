const elixir = require('laravel-elixir');
var gulp = require('gulp');

//require('laravel-elixir-vue-2');

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


/**
 * 拷贝任何需要的文件
 *
 * Do a 'gulp copyfiles' after bower updates
 */
gulp.task("copyfiles", function() {

    //后端组件资源根据需要copy到public目录
    gulp.src("resources/assets/bower_components/**")
        .pipe(gulp.dest("public/assets/vendor"));

    //Copy jQuery 
    gulp.src("resources/assets/bower_components/jquery/dist/jquery.js")
        .pipe(gulp.dest("resources/assets/js/"));

    //Copy Bootstrap
    gulp.src("resources/assets/bower_components/bootstrap/dist/js/bootstrap.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("resources/assets/bower_components/bootstrap/less/**")
        .pipe(gulp.dest("resources/assets/less/bootstrap"));

    gulp.src("resources/assets/bower_components/bootstrap/dist/fonts/**")
        .pipe(gulp.dest("public/assets/fonts"));

    //Copy Fontawesome
    gulp.src("resources/assets/bower_components/fontawesome/less/**")
        .pipe(gulp.dest("resources/assets/less/fontawesome"));

    gulp.src("resources/assets/bower_components/fontawesome/fonts/**")
        .pipe(gulp.dest("public/assets/fonts"));

    //Copy swiper
    gulp.src("resources/assets/bower_components/swiper/dist/js/swiper.jquery.min.js")
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src("resources/assets/bower_components/swiper/dist/css/swiper.min.css")
        .pipe(gulp.dest("public/assets/css"));

});


/**
 * Default gulp is to run this elixir stuff
 */
elixir(mix => {
    
    // 合并 scripts
    mix.scripts([
        'js/jquery.js',
        'js/bootstrap.js',
        'js/swiper.jquery.min.js'
        //'js/jquery.backstretch.min.js',
        
        ],
        'public/assets/js/components.js','resources/assets'
    );

    mix.copy('resources/assets/js/mainsite.js', 'public/assets/js');
    mix.copy('resources/assets/js/homepage.js', 'public/assets/js');

    // Compile CSS
    mix.less('mainsite.less', 'public/assets/css/mainsite.css');

    /**
    mix.sass('app.scss')
       .webpack('app.js');
    */
});


