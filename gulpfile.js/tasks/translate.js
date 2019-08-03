/**
 * Generate Translation POT File
 *
 * Compiles:
 *      lang/wp-my-admin-bar.pot
 *
 * @command gulp translate
 */
var gulp 				= require('gulp');
var sort 				= require('gulp-sort');
var notify 				= require('gulp-notify');
var wpPot 				= require('gulp-wp-pot');
var text_domain         = 'wp-my-admin-bar';
var bug_report          = 'https://github.com/ChrisWinters/wp-my-admin-bar/issues';
var translator_contact 	= 'ChrisW. <chrisw@null.net>';
var team_contact        = 'ChrisW. <chrisw@null.net>';


/**
 * Create Translation File
 */
gulp.task('translate', function () {
    return gulp.src(['!/node_modules', '!/css', '!/fonts', '!/js', '!/lang', './**/*.php', './*.php'])
    .pipe(sort())
    .pipe(wpPot({domain: text_domain, package: text_domain, bugReport: bug_report, lastTranslator: translator_contact, team: team_contact}))
    .pipe(gulp.dest('./lang/wp-my-admin-bar.pot'))
    .pipe(notify({message: 'Task "translate" created wp-my-admin-bar.pot', onLast: true}))
    .on('error', console.error.bind(console))
});
