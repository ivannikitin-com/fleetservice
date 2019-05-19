var syntax         = 'scss', // Syntax: sass or scss;
		gulpVersion    = '4'; // Gulp version: 3 or 4
		gmWatch        = false; // ON/OFF GraphicsMagick watching "img/_src" folder (true/false). Linux install gm: sudo apt update; sudo apt install graphicsmagick

var gulp          = require('gulp'),
		gutil         = require('gulp-util' ),
		sass          = require('gulp-sass'),
		browserSync   = require('browser-sync'),
		concat        = require('gulp-concat'),
		uglify        = require('gulp-uglify'),
		cleancss      = require('gulp-clean-css'),
		rename        = require('gulp-rename'),
		autoprefixer  = require('gulp-autoprefixer'),
		notify        = require('gulp-notify'),
		rsync         = require('gulp-rsync'),
		imageResize   = require('gulp-image-resize'),
		imagemin      = require('gulp-imagemin'),
		del           = require('del');

// Local Server
gulp.task('browser-sync', function() {
	browserSync({
		proxy: 'http://exmaple.local/', // Указать свой адрес сервера разработки
		notify: false,
		// open: false,
		// online: false, // Work Offline Without Internet Connection
		// tunnel: true, tunnel: "projectname", // Demonstration page: http://projectname.localtunnel.me
	})
});

// Sass|Scss Styles
gulp.task('styles', function() {
	return gulp.src(''+syntax+'/**/*.'+syntax+'')
	.pipe(sass({ outputStyle: 'expanded' }).on("error", notify.onError()))
	.pipe(rename({ prefix : '' }))
	.pipe(autoprefixer({ grid: true, browsers: ['last 2 versions', 'ie 6-8', 'Firefox > 20']  }))
	.pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
	.pipe(gulp.dest('css'))
	.pipe(browserSync.reload( {stream: true} ))
});

// JS
gulp.task('scripts', function() {
	return gulp.src([])
	//.pipe(concat('scripts.min.js'))
	// .pipe(uglify()) // Mifify js (opt.)
	.pipe(gulp.dest('js'))
	.pipe(browserSync.reload({ stream: true }))
});

// If Gulp Version 4
if (gulpVersion == 4) {
		gulp.task('watch', function() {
		gulp.watch(''+syntax+'/**/*.'+syntax+'', gulp.parallel('styles'));
		gulp.watch( '**/*.php', browserSync.reload);
	});
	
	gulp.task('default', gulp.parallel('styles', 'browser-sync', 'watch'));

};
