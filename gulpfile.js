let cocktail = require('cocktail-of-tasks');

cocktail(function(mix) {
    mix
        .webpack([
            {
                name: "app",
                from: "js/app.js"
            }
        ])
        .scss([
            {
                name: "app",
                from: "scss/app.scss",
            }
        ]);
});
