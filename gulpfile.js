var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    // We want to execute less on the given file - resources/assets/less/app.less
    // mix.less('app.less');

    // We want to use sass though
    // gulp to execute it
    // gulp watch to set it so that it monitors any changes to the files to auto-execute
  //  mix.sass('app.scss');

    // We can combine CSS files together for the final version
    // The second parameter is = where the output file should go
    // The third parameter is where to find the files as by default elixir will try to find it within /resources/assets/
    // In the console just add gulp --production to minify the file


    /*
    mix.styles([
        'vendor/normalize.css',
        'app.css',
     ], 'public/output/final.css', 'public/css');
    */


    // Convert the sass file
    mix.sass('app.scss');

    // Combine the files and output the file
    mix.styles([
        'vendor/normalize.css',
        'app.css'
    ], null, 'public/css');

    // As we are using the version function all-<unique_code>.css gets created within /public/build/css/
    mix.version('public/css/all.css');









    /*
    // We can do the same with javascript
    mix.scripts({
        'vendor/jquery.js',
        'main.js'
    }, 'public/output/final.js', 'public/js');
    */

    // We can also do PHP unit tests
    // If we do gulp tdd which will automatically run the unit tests for PHP and alert on success/fail
    mix.phpUnit();
});
