/**
 * Copy Theme Assets inc/assets to /assets
 *
 * @command gulp assets
 */
var gulp    = require('gulp');
var del     = require('del');
var notify  = require('gulp-notify');
var concat  = require('gulp-concat');
var replace = require('gulp-replace');


/**
 * Clear Old Copied Assets
 */
gulp.task('clean-assets', function(){
     return del(['./assets/css/bootstrap4'], {force:true});
});


/**
 * Copy Assets
 */
gulp.task('assets', function(done) {
    var stream

    gulp.src('./node_modules/bootstrap/scss/**/*.scss').pipe(gulp.dest('./assets/css/bootstrap4'))
    .pipe(notify({message: 'Assets Moved', onLast: true}))

    done();
    return stream
});