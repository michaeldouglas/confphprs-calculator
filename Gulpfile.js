var gulp = require('gulp');
var gutil = require('gulp-util');
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');

gulp.task('confphprs-scritps', function(){
    return gulp
        .src(['resources/js/**/*.js'])
        .pipe(uglify())
        .pipe(gulp.dest('public/src/js'));
});