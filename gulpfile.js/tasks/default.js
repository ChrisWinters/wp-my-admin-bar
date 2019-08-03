/**
 * Default Task Commands
 *
 * @command gulp default
 * @command gulp all
 * @command gulp watch
 * @command gulp clean
 */
var project_url = 'multisite.localhost';
var gulp        = require('gulp');
var del        	= require('del');
var browserSync = require('browser-sync');

function browserReload(done) {
  browserSync.reload();
  done();
}


/**
 * Default Task
 */
gulp.task('default', gulp.series('style'));


/**
 * Run All Builder Tasks
 */
gulp.task('all', gulp.series(
	'assets',
	[
	'style',
	'translate'
	]
));


/**
 * Watch For File Changes & Run Tasks
 */
gulp.task('watch', gulp.series('style', function() {
    gulp.watch(['!/node_modules', './**/*.php', './*.php'], gulp.series(browserReload))
    gulp.watch(['./inc/css/scss/*.scss', './inc/css/scss/**/*.scss'], gulp.series('style', browserReload))
    gulp.watch(['./inc/css/scss/scripts.js'], gulp.series('scripts', browserReload))
    browserSync.init({proxy: project_url, injectChanges: true, open: true})
}));


/**
 * Delete Theme Assets After Compile
 */
gulp.task('clean', function() {
    return del(['assets'])
});
