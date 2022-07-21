const mix = require("laravel-mix");

mix.js("resources/js/admin/app.js", "public/js")
    .vue()
    .postCss("resources/css/app.css", "public/css", [
        require('postcss-import'),
        require("tailwindcss"),
        require('autoprefixer'),
    ])
    .version();