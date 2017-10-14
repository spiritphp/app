let builder = require('gulp-query')
  , webpack = require('gulp-query-webpack')
  , scss = require('gulp-query-scss')
  , copy = require('gulp-query-copy')
;

builder((query) => {
  query
    .plugins(webpack, scss, copy)
    .webpack('resources/assets/js/app.js','public/js','app')
    .scss('resources/assets/scss/app.scss','public/css','app')

    //.copy('node_modules/jquery/dist/jquery.min.js','public/js','jquery')
  ;
});
