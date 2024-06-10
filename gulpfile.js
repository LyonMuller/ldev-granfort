// Adiciona os modulos instalados
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const sassGlob = require('gulp-sass-glob');

// Funçao para compilar o SASS e adicionar os prefixos
function compilaSass() {
  return (
    gulp
      // adiciona mais lugar para buscar os arquivos
      .src(['./.dev/sass/*.sass', './.dev/sass/main-files/*.sass'])
      .pipe(sassGlob())
      .pipe(
        sass({
          outputStyle: 'compressed',
        }),
      )
      .pipe(
        autoprefixer({
          cascade: false,
        }),
      )
      .pipe(gulp.dest('assets/css/'))
      .pipe(browserSync.stream())
  );
}

// Tarefa de gulp para a função de SASS
gulp.task('sass', function (done) {
  compilaSass();
  done();
});

// Função para juntar o JS
gulp.task('javascript', () =>
  gulp.src('./.dev/js/products.js') // Caminho para seus arquivos JavaScript
  .pipe(babel({
    presets: ['@babel/preset-env']
  }))
  .pipe(gulp.dest('assets/js')) // Onde você quer salvar seus arquivos transpilados
);


// Função para iniciar o browser
function browser() {
  browserSync.init({
    proxy: 'https://granfort.local',
    notify: false
  });
}

// Tarefa para iniciar o browser-sync
gulp.task('browser-sync', browser);

// Função de watch do Gulp
function watch() {
  gulp.watch('./.dev/**/*.scss', compilaSass);
  gulp.watch('./.dev/**/*.sass', compilaSass);
  gulp.watch(['./assets/**/*.js', './assets/css/*-critical.css', '*.php', './**/*.php']).on('change', browserSync.reload);
  gulp.watch('./assets/**/*').on('change', browserSync.reload);
}

// Inicia a tarefa de watch
gulp.task('watch', watch);

// Tarefa padrão do Gulp, que inicia o watch e o browser-sync
gulp.task('default', gulp.parallel('watch', 'sass', 'browser-sync'));
