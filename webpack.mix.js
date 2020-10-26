let mix = require('laravel-mix')

mix.js('resources/js/app.js', 'dist/js').setPublicPath('dist')

mix.postCss('resources/css/app.css', 'dist/css', [
    require('tailwindcss'),
])
