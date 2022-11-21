const {src,dest,parallel,watch} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
var plumber = require('gulp-plumber');
function css( cb ){
    src("src/css/**/*.scss").pipe(plumber()).pipe(sass()).pipe(dest("build/css"));
    cb();
}
function watchFiles( done ){
    watch("src/css/**/*.scss", css);
    done();
}
exports.css=css;
exports.watchFiles=watchFiles;
exports.default=parallel(css,watchFiles);