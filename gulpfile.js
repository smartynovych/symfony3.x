var gulp   = require('gulp');
var sass   = require('gulp-sass');
var concat = require('gulp-concat');
var watch  = require('gulp-watch');

gulp.task('fonts', function () {
    return gulp.src('node_modules/bootstrap/fonts/*')
        .pipe(gulp.dest('web/fonts'))
});

gulp.task('sass', function(){
    gulp.src('src/AppBundle/Resources/public/saas/style.scss')
        .pipe(sass())
        .pipe(gulp.dest('web/css'));
});

gulp.task('scripts', function(){
    var scripts = [
        // Dist
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/popper.js/dist/popper.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        // App
        'src/AppBundle/Resources/public/js/app.js'
    ];

    gulp.src(scripts)
        .pipe(concat('script.js'))
        .pipe(gulp.dest('web/js'));
});

gulp.task('watch', function() {
    gulp.watch('src/AppBundle/Resources/public/js/**/*', ['scripts']);
    gulp.watch('src/AppBundle/Resources/public/sass/**/*', ['sass']);
});

gulp.task('default', [
    'fonts',
    'sass',
    'scripts'
]);