/*=============================================
=            Gulp Starter by @JA              =
=============================================*/

/**
 *
 * The packages we are using
 * Not using gulp-load-plugins as it is nice to see whats here.
 *
 **/
var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync');
var prefix = require('gulp-autoprefixer');
var plumber = require('gulp-plumber');
var jshint = require('gulp-jshint');
var stylish = require('jshint-stylish');
var uglify = require('gulp-uglify');
var rename = require("gulp-rename");
var imagemin = require("gulp-imagemin");
var pngquant = require('imagemin-pngquant');
var gulpCopy = require('gulp-copy');
var inject = require('gulp-inject');
var bs = require("browser-sync").create();

/**
 *
 * Styles
 * - Auto-Import
 * - Compile
 * - Compress/Minify
 * - Catch errors (gulp-plumber)
 * - Autoprefixer
 *
 **/



gulp.task('sass', function() {
  gulp.src('src/assets/scss/style.scss')
  .pipe(inject(gulp.src(['**/*.scss'], {read: false, cwd: 'src/assets/scss'}), {
    starttag: '/* IMPORTS */',
    endtag: '/* Fin des IMPORTS */',
    transform: function (filepath) {
      var res = '@import \'' + filepath + '\';';
      console.log(res);
      return res;
    }
  }))
  .pipe(sass({outputStyle: 'compressed'})) //
  .pipe(prefix('last 2 versions', '> 1%', 'ie 8', 'Android 2', 'Firefox ESR', 'ie 11'))
  .pipe(plumber())
  .pipe(gulp.dest('dist/assets/css'));
});

/**
 *
 * BrowserSync.io
 * - Watch CSS, JS & HTML for changes
 * - View project at: localhost:3000
 *
 **/
gulp.task('browser-sync', function() {
    browserSync.init(['dist/**/css/*.css', 'dist/**/*.js', 'src/**.html'], {
        server: {
            baseDir: './dist'
        }
    });
});


/**
 *
 * Javascript
 * - Uglify
 * - JsLint
 *
 **/
gulp.task('scripts', function() {

    //source
    gulp.src('src/assets/js/**/*.js')

    //lint
    .pipe(jshint())
        .pipe(jshint.reporter(stylish))

    //uglify
    .pipe(uglify())

    //rename
    .pipe(rename({
        dirname: "min",
        suffix: ".min",
    }))

    .pipe(gulp.dest('dist/assets/js'))
});



/**
 *
 * Images
 * - Compress them!
 *
 **/
gulp.task('images', function() {
    return gulp.src('src/**/images/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{
                removeViewBox: false
            }],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('dist'));
});

/**
 *
 * Copy
 * - Copy the index.html!
 *
 **/

gulp.task('copy', function() {
    gulp.src('src/index.html')
        .pipe(gulp.dest('dist'));
    gulp.src('src/views/*.html')
        .pipe(gulp.dest('dist/views'));
    gulp.src('src/lib/**/*')
        .pipe(gulp.dest('dist/lib'));
});


/**
 *
 * Default task
 * - Runs sass, browser-sync, scripts and image tasks
 * - Watchs for file changes for images, scripts and sass/css
 *
 **/
gulp.task('default', ['sass', 'scripts', 'images', 'copy', 'browser-sync'], function() {
    gulp.watch('src/assets/scss/**/*.scss', ['sass']);
    gulp.watch('src/**/*.js', ['scripts']);
    gulp.watch('src/assets/images/*', ['images']);
    gulp.watch('src/index.html', ['copy']);
    gulp.watch('src/views/*.html', ['copy']);
});




// gulp.task('prod', ['sass', 'scripts', 'images'], function () {

// });
