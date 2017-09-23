let builder = require('gulp-query')
  , webpack = require('gulp-query-webpack')
  , scss = require('gulp-query-scss')
;

builder((query) => {
  query
    .plugins(webpack, scss)
    .webpack('resources/assets/js/app.js','public/js','app')
    .scss('resources/assets/scss/app.scss','public/css','app')
  ;
});
