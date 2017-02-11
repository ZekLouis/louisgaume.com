var gulp = require('gulp')
var sass = require('gulp-sass')

gulp.task('sass',function(){
  return gulp.src('css/style.scss')
    .pipe(sass())
    .pipe(gulp.dest('css'))
})

gulp.task('default',function(){
  gulp.watch('css/style.scss', ['sass'])
})
