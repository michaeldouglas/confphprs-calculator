var gulp = require('gulp');
var gutil = require('gulp-util');
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');

gulp.task('portal-scritps', function(){
    return gulp
        .src(['js/**/*.js'])
        .pipe(uglify())
        .pipe(gulp.dest('build/js   '));
});