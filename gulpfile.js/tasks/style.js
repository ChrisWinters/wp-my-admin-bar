/**
 * Default Theme styleheet
 *
 * Compiles:
 *      style.css
 *      style.min.css
 *
 * @command gulp style
 * @command gulp style.css
 * @command gulp style.min.css
 */
var gulp 			= require('gulp');
var sass            = require('gulp-sass');
var notify          = require('gulp-notify');
var rename          = require('gulp-rename');
var autoprefixer    = require('gulp-autoprefixer');
var noComments      = require('gulp-strip-css-comments');
var removeEmpty     = require('gulp-remove-empty-lines');
var lineec          = require('gulp-line-ending-corrector');
const autoprefixers = [
    'last 2 version',
    '> 1%',
    'ie >= 9',
    'ie_mob >= 10',
    'ff >= 30',
    'chrome >= 34',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4',
    'bb >= 10'
];


/**
 * Compile Theme Stylesheets
 */
gulp.task('style', gulp.series(
    'style.css',
    'style.min.css',
));


/**
 * Create style.css
 */
gulp.task('style.css', function () {
    return gulp.src('./assets/css/scss/style.scss')
    .pipe(sass({outputStyle:'compact'}))
    .pipe(noComments())
    .pipe(lineec())
    .pipe(removeEmpty({removeComments: true}))
    .pipe(autoprefixer(autoprefixers))
    .pipe(gulp.dest('./assets/css'))
    .pipe(notify({message: 'Created "style.css"', onLast: true}))
    .on('error', console.error.bind(console))
});


/**
 * Create style.min.css
 */
gulp.task('style.min.css', function () {
    return gulp.src('./assets/css/scss/style.scss')
    .pipe(sass({outputStyle:'compressed'}))
    .pipe(noComments())
    .pipe(lineec())
    .pipe(removeEmpty({removeComments: true}))
    .pipe(autoprefixer(autoprefixers))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('./assets/css'))
    .pipe(notify({message: 'Created "style.min.css"', onLast: true}))
    .on('error', console.error.bind(console))
});
