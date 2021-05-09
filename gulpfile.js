/* eslint max-len: 0, no-unused-vars: 0 */

// Require Gulp first
const gulp = require('gulp');
//  packageJson = require('./package.json'),
// Load plugins
const $ = require('gulp-load-plugins')({
  lazy: true,
});

// postcss
const postcss = require('gulp-postcss');
// SASS
const sass = require('gulp-sass');
sass.compiler = require('node-sass');
// Critical CSS
const critical = require('critical');
// Stylelint
const StyleLint = require('gulp-stylelint');

// Imagemin and Plugins
const imagemin = require('gulp-imagemin');
const mozjpeg = require('imagemin-mozjpeg');
// const imageminGuetzli = require('imagemin-guetzli');
const imageminWebp = require('imagemin-webp');

// Browsersync (or browser-sync as it's called now)
const browsersync = require('browser-sync').create();
// explicitly require eslint
const eslint = require('gulp-eslint');
//explicitly require rimraf
const rimraf = require('gulp-rimraf');

/**
 * @name sass
 * @description SASS conversion task to produce development css with expanded syntax.
 *
 * We run this task against Dart SASS, not lib SASS.
 *
 * @see {@link http://sass-lang.com|SASS}
 * @see {@link http://sass-compatibility.github.io/|SASS Feature Compatibility}
 *
 * @return {string}
 */
gulp.task('sass', () => {
  return gulp.src('./sass/**/*.scss')
    .pipe($.sourcemaps.init())
    .pipe(sass({
      outputStyle: 'expanded'
    }).on('error', sass.logError))
    .pipe($.sourcemaps.write('.'))
    .pipe(gulp.dest('./temp'));
})

/**
 * @name processCSS
 *
 * @description Run autoprefixer and cleanCSS on the CSS files under ./src/css
 *
 * Moved from gulp-autoprefixer to postcss. It may open other options in the future
 * like cssnano to compress the files
 *
 * @see {@link https://github.com/postcss/autoprefixer|autoprefixer}
 *
 * @return {string}
 */
gulp.task('processCSS', () => {
  const plugins = [require('autoprefixer')];

  return gulp.src('./temp/**/*.css')
    .pipe($.sourcemaps.init())
    .pipe(postcss(plugins))
    .pipe($.sourcemaps.write('.'))
    .pipe(gulp.dest('./'));
})

/**
 * @name generateUncss
 * @description Taking a css and an html file, UNCC will strip all CSS selectors not used in the page
 *
 * @see {@link https://github.com/giakki/uncss|uncss}
 *
 * @return {string}
 */
gulp.task('generateUncss', () => {
  return gulp.src('src/css/**/*.css')
    .pipe($.uncss({
      html: ['index.html'],
    }))
    .pipe(gulp.dest('css/main.css'))
    .pipe($.size({
      pretty: true,
      title: 'Uncss',
    }));
})

/**
 * @name generateCriticalCSS
 *
 * @return {void}
 */
gulp.task('generateCriticalCSS', () => {
  return gulp.src('src/*.html')
    .pipe(critical({
      base: './src/',
      inline: true,
      css: ['./src/css/main.css'],
      minify: true,
      extract: false,
      ignore: ['font-face'],
      dimensions: [{
        width: 320,
        height: 480,
      }, {
        width: 768,
        height: 1024,
      }, {
        width: 1280,
        height: 960,
      }],
    }))
    .pipe($.size({
      pretty: true,
      title: 'Critical',
    }))
    .pipe(gulp.dest('dist'));
})

gulp.task('lint:css', () => {
  return gulp.src([
    '**/*.css', '!node_modules/**'
  ])
  .pipe(StyleLint({
    reporters: [
      {formatter: 'string', console: true}
    ]
  }));
})

/**
 * @name babel
 * @description Transpiles ES6 to ES5 using Babel. As Node and browsers support more of the spec natively this will move to supporting ES2016 and later transpilation
 *
 * It requires the `babel`and the `babel-preset-env` plugin
 *
 * @see {@link http://babeljs.io/|Babel}
 * @see {@link http://babeljs.io/docs/learn-es2015/|Learn ES2015}
 * @see {@link http://www.ecma-international.org/ecma-262/6.0/|ECMAScript 2015 specification}
 * @return {void}
 */
gulp.task('babel', () => {
  return gulp.src('src/scripts/**/*.js')
    .pipe($.sourcemaps.init())
    .pipe($.babel({
      presets: ['@babel/env'],
    }))
    .pipe($.sourcemaps.write('.'))
    .pipe(gulp.dest('src/js/'))
    .pipe($.size({
      pretty: true,
      title: 'Babel',
    }));
})

/**
 * @name eslintCheck
 * @description Runs eslint on all javascript files
 * @return {void}
 */
gulp.task('eslint', () => {
  return gulp.src([
      'scr/scripts/**/*.js',
    ])
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
})

/**
 * @name generateJSdoc
 * @description runs jsdoc on the gulpfile and README.md to genereate documentation
 *
 * @see {@link https://github.com/jsdoc3/jsdoc|JSDOC}
 * @return {void}
 */
gulp.task('jsdoc', () => {
  return gulp.src(['./README.md', './gulpfile.js'])
    .pipe($.jsdoc3())
})

/**
 * @name processImages
 * @description Reduces image file sizes. Doubly important if we'll choose to play with responsive images.
 *
 * Imagemin will compress jpg (using mozilla's mozjpeg), SVG (using SVGO) GIF and PNG images but WILL NOT create multiple versions for use with responsive images
 *
 * @see {@link https://github.com/postcss/autoprefixer|Autoprefixer}
 * @see {@link generateResponsive}
 * @return {void}
 */
gulp.task('processImages', () => {
  return gulp.src('src/images/originals/**')
    .pipe(imagemin([
        imagemin.gifsicle({
          interlaced: true
        }),
        imagemin.optipng({
          optimizationLevel: 5
        }),
        imagemin.svgo({
          plugins: [{
              removeViewBox: false
            },
            {
              cleanupIDs: false
            },
          ]
        }),
        mozjpeg(),
        imageminWebp({
          quality: 85
        }),
      ])
      .pipe(gulp.dest('src/images'))
    );
})

/**
 * @name generateResponsive
 * @description generateResponsive creates a set of responsive images for each of the PNG and JPG images in the images
 * directory
 *
 * @see {@link http://sharp.dimens.io/en/stable/install/|Sharp}
 * @see {@link https://github.com/jcupitt/libvips|LibVIPS dependency for Mac}
 * @see {@link https://www.npmjs.com/package/gulp-responsive|gulp-responsive}
 * @see {@link imagemin}
 *
 * @return {string}
 */
gulp.task('generateResponsive', () => {
  return gulp.src(['./src/images/**/*.{jpg,png}', '!./src/images/touch/*.png'])
    .pipe($.responsive({
        '*': [{
          // image-small.jpg is 200 pixels wide
          width: 200,
          rename: {
            suffix: '-small',
            extname: '.jpg',
          },
        }, {
          // image-small@2x.jpg is 400 pixels wide
          width: 200 * 2,
          rename: {
            suffix: '-small@2x',
            extname: '.jpg',
          },
        }, {
          // image-large.jpg is 480 pixels wide
          width: 480,
          rename: {
            suffix: '-large',
            extname: '.jpg',
          },
        }, {
          // image-large@2x.jpg is 960 pixels wide
          width: 480 * 2,
          rename: {
            suffix: '-large@2x',
            extname: '.jpg',
          },
        }, {
          // image-extralarge.jpg is 1280 pixels wide
          width: 1280,
          rename: {
            suffix: '-extralarge',
            extname: '.jpg',
          },
        }, {
          // image-extralarge@2x.jpg is 2560 pixels wide
          width: 1280 * 2,
          rename: {
            suffix: '-extralarge@2x',
            extname: '.jpg',
          },
        }, {
          // image-small.webp is 200 pixels wide
          width: 200,
          rename: {
            suffix: '-small',
            extname: '.webp',
          },
        }, {
          // image-small@2x.webp is 400 pixels wide
          width: 200 * 2,
          rename: {
            suffix: '-small@2x',
            extname: '.webp',
          },
        }, {
          // image-large.webp is 480 pixels wide
          width: 480,
          rename: {
            suffix: '-large',
            extname: '.webp',
          },
        }, {
          // image-large@2x.webp is 960 pixels wide
          width: 480 * 2,
          rename: {
            suffix: '-large@2x',
            extname: '.webp',
          },
        }, {
          // image-extralarge.webp is 1280 pixels wide
          width: 1280,
          rename: {
            suffix: '-extralarge',
            extname: '.webp',
          },
        }, {
          // image-extralarge@2x.webp is 2560 pixels wide
          width: 1280 * 2,
          rename: {
            suffix: '-extralarge@2x',
            extname: '.webp',
          },
        }, {
          // Global configuration for all images
          // The output quality for JPEG, WebP and TIFF output formats
          quality: 80,
          // Use progressive (interlace) scan for JPEG and PNG output
          progressive: true,
          // Skip enalrgement warnings
          skipOnEnlargement: false,
          // Strip all metadata
          withMetadata: true,
        }],
      })
      .pipe(gulp.dest('dist/images')));
})

/**
 * @name clean
 * @description deletes specified files
 * @return {void}
 */
gulp.task('clean', (cb) => {
  return gulp.src(
    './temp/',
    './style.css',
    './style.css.map',
    './woocommerce.css',
    './woocommerce.css.map',
    cb
  ).pipe(rimraf())
})

/**
 * @name generateCSS
 * @description SASS and process CSS
 */
gulp.task('generateCSS',
  gulp.series('sass', 'processCSS'),
  (done) => {
    console.log('Done generating CSS');
    done();
  })

/**
 * @name watch
 * @description Watches different files and acts upon any changes
 */
gulp.task('server', () => {

  browsersync.init({
    proxy: "localhost:8888/wordpress",
  });

  // gulp.watch('js/**/*.js', gulp.series('babel'));
  gulp.watch('sass/**/*.scss', gulp.series('generateCSS'));
  gulp.watch('**/*').on('change', browsersync.reload);
})

/**
 * @name default
 * @description uses clean, processCSS, build-template, processImages and copyAssets to build the HTML content from Markdown source
 */
gulp.task('default',
  gulp.series('server'), () => {
    console.log('Done with default task');
  })
