const gulp = require('gulp')
const livereload = require('gulp-livereload')
const open = require('gulp-open')
const sass = require('gulp-sass')
const minify = require('gulp-minify')
const cleanCss = require('gulp-clean-css')
const rename = require("gulp-rename")
const bundle = require('gulp-bundle-assets')
const wait = require('gulp-wait')

gulp.task('compile-sass', function () {
	return gulp.src(['frontend/design/scss/*.scss'])
		.pipe(wait(500))
		.pipe(sass())
		.pipe(cleanCss({level: {1: {specialComments: 0}}}))
		.pipe(rename({ suffix: '.min' }))
		.pipe(gulp.dest('frontend/web/css'))
		.pipe(livereload({ start: true }))
})

gulp.task('compile-js', function () {
	return gulp.src(['frontend/design/scripts/*.js'])
		.pipe(wait(500))	
		.pipe(minify({
			ext: { min: '.min.js' },
			noSource: true
		}))
		.pipe(gulp.dest('frontend/web/js'))
		.pipe(livereload({ start: true }))
})

gulp.task('views', function () {
	return gulp.src('frontend/views/**/*.php')
		.pipe(wait(500))	
		.pipe(livereload({ start: true }))
})

gulp.task('controllers', function(){
	return gulp.src('frontend/controllers/*.php')
		.pipe(wait(500))	
		.pipe(livereload({ start: true }))
})

gulp.task('css-bundle', function () {
	return gulp.src('./css-bundle.config.js')
		.pipe(wait(500))	
		.pipe(bundle())
		.pipe(cleanCss({level: {1: {specialComments: 0}}}))
		.pipe(rename({
				basename: "vendor",
				suffix: ".min"
		}))
		.pipe(gulp.dest('frontend/web/bundle/css'));
})

gulp.task('js-bundle', function () {
	return gulp.src('./js-bundle.config.js')
		.pipe(wait(500))	
		.pipe(bundle())
		.pipe(rename({
				basename: "vendor",
				suffix: ".min"
		}))
		.pipe(gulp.dest('frontend/web/bundle/js'));
})

gulp.task('nano-1', function () {
	return gulp.src(['frontend/web/assets/nanogallery2/dist/css/loading.gif'])
		.pipe(gulp.dest('frontend/web/bundle/css'))
})

gulp.task('nano-2', function () {
	return gulp.src(['frontend/web/assets/nanogallery2/dist/css/font/*.*'])
		.pipe(gulp.dest('frontend/web/bundle/css/font'))
})

gulp.task('fa', function () {
	return gulp.src(['frontend/web/assets/components-font-awesome/fonts/*.*'])
		.pipe(gulp.dest('frontend/web/bundle/fonts'))
})

gulp.task('copy', ['fa', 'nano-1', 'nano-2'])
gulp.task('bundle', ['css-bundle', 'js-bundle', 'copy'])

gulp.task('watch', function () {
	livereload.listen()
	gulp.watch(['frontend/design/scss/*.scss'], ['compile-sass'])
	gulp.watch(['frontend/design/scripts/*.js'], ['compile-js'])

	gulp.watch(['frontend/views/**/*.php'], ['views'])
	gulp.watch(['frontend/controllers/*.php'], ['controllers'])
})

gulp.task('uri', function () {
	gulp.src(__filename)
		.pipe(open({ uri: 'http://fr.ppei.io' }))
})

gulp.task('serve', ['bundle', 'watch', 'uri'])
gulp.task('default', ['serve'])
