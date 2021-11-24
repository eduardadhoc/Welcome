const {
  src,
  dest,
  series,
  parallel,
  watch,
  task
} = require('gulp');
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const babel = require('gulp-babel');
const sass = require('gulp-dart-sass');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const postcss = require('gulp-postcss');
const prettyUrl = require('gulp-pretty-url');
//const image = require('gulp-image');
const nunjucksRender = require('gulp-nunjucks-render');
const downloader = require('goog-webfont-dl');
const browserSync = require('browser-sync').create();
const purgecss = require('gulp-purgecss');

const config = require('./config.js')();

//Purgar css
task('purgecss', () => {
  return src('_maqueta/**/*.css')
    .pipe(purgecss({
      content: ['_maqueta/**/*.html']
    }))
    .pipe(dest('public/'))
})

//Copiar arxius a producció
task('copyPro', () => {
  return src(['_maqueta/**/*.html', '_maqueta/assets/**', '_maqueta/fav/**'], {
      base:'./_maqueta/'
    })
    .pipe(dest('public/'))
})


//Descarregar Google Fonts
// Descarrega les tipografies de google
task('download:fonts', (cb) => {
  for (let font in config.googleFonts) {
    if ({}.hasOwnProperty.call(config.googleFonts, font)) {
      let types = config.googleFonts[font];

      downloader({
        font: font,
        formats: downloader.formats, // Font formats.
        destination: './_maqueta/assets/fonts/',
        out: './src/scss/base/_googleFonts_' + font + '.scss',
        prefix: 'assets/fonts/',
        styles: types
      });
    }
  }

  cb();
});

function jsTask() {
  return src(['./src/js/**/*.js'], {
      allowEmpty: true
    })
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ['@babel/env']
    }))
    .pipe(concat('bundle.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./_maqueta/assets/js'))
}

function nunjucksTask() {
  return src([
      './src/pages/**/*.html',
      './src/pages/**/*.njk'
    ], {
      allowEmpty: true
    })
    .pipe(nunjucksRender({
      path: [
        'src/templates/',
        'src/pages/',
      ]
    }))
    .pipe(prettyUrl())
    .pipe(dest('./_maqueta'))
}

function cssTask() {
  return src('./src/scss/style.scss', {
      allowEmpty: true
    })
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'compressed'
    })).on('error', sass.logError)
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./_maqueta/'))
}

/*
function imageTask() {
  return src('./src/assets/img/*', {
      allowEmpty: true
    })
    .pipe(image({
      pngquant: true,
      optipng: false,
      zopflipng: true,
      jpegRecompress: false,
      mozjpeg: true,
      gifsicle: true,
      svgo: true,
      concurrent: 10,
      quiet: false
    }))
    .pipe(dest('./_maqueta/assets/img'))
}
*/

function liveReload(done) {
  browserSync.init({
    server: {
      baseDir: './_maqueta'
    },
  });
  done();
}

function reload(done) {
  browserSync.reload();
  done();
}

function watchFiles() {
  watch('./src/templates/**/*', series(nunjucksTask, reload));
  watch('./src/pages/**/*', series(nunjucksTask, reload));
  watch('./src/js/**/*.js', series(jsTask, reload));
  watch('./src/scss/**/*', series(cssTask, reload));
  //watch('./src/assets/img/', series(imageTask, reload));
};

exports.default = parallel(nunjucksTask, jsTask, cssTask, parallel(liveReload, watchFiles));
