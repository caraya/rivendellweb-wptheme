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
// Stylelint
const StyleLint = require('gulp-stylelint');

// explicitly require eslint
const eslint = require('gulp-eslint');
//explicitly require rimraf
const rimraf = require('gulp-rimraf');
// merge streams
const merge = require('merge-stream');

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
 * @name clean
 * @description deletes specified files
 * @return {void}
 */
gulp.task('clean', (cb) => {
  return gulp.src(
    './temp/',
    './rivendellweb-theme',
    './editor-styles.css',
    './editor-styles.css.map',
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


gulp.task('prepare-artifact', () => {
  // Stream for files that go at the root of the artifact
  let contentStream = gulp.src([
    '*.php',
    '*.css',
    './README.md',
    './readme.txt',
    './screenshot.png',
    './fonts/',
    './images/',
    './inc/',
    './languages/',
    './layouts/',
    './template-parts',
    '!./gulpfile.js',
    '!./postcss.config.js',
    '!./node*/',
    '!./gulpfile.js',
    '!./postcss.config.js'],
    {
      base: '.',
    })
    .pipe(gulp.dest('rivendellweb-theme/'));
  let cssStream = gulp.src([
    './css/*.css',
    '!./temp',
    '!./node*/',
    '!./gulpfile.js',
    '!./postcss.config.js'],
    {
      base: 'css',
    }
  )
    .pipe(gulp.dest('rivendellweb-theme/css/'));
  let jsStream = gulp.src([
    'js/*.js',
    '!./node*/',
    '!./gulpfile.js',
    '!./postcss.config.js'],
    {
      base: 'js',
    }
  )
    .pipe(gulp.dest('rivendellweb-theme/js/'));
  return merge(cssStream, jsStream);

})

/**
 * @name default
 * @description uses clean, generateCSS, and prepare-artifact to generate the theme folder that we'll save as an artifact with Github actions
 */
gulp.task('default',
  gulp.series('clean','prepare-artifact'), () => {
    console.log('Done with default task');
  })
