var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
  // bootstrap compilation
	 mix.sass('bootstrap.scss', './public/assets/global/plugins/bootstrap/css/')

	  // select2 compilation using bootstrap variables
		.sass('./resources/assets/global/plugins/select2/sass/select2-bootstrap.min.scss', './public/assets/global/plugins/select2/css')

	  // global theme stylesheet compilation
		.sass('global/*.scss', './public/assets/global/css')
		.sass('apps/*.scss', './public/assets/apps/css')
		.sass('pages/*.scss', './public/assets/pages/css')

	  // theme layouts compilation
	  	.sass('layouts/layout4/*.scss', './public/assets/layouts/layout4/css')
	  	.sass('layouts/layout4/themes/*.scss', './public/assets/layouts/layout4/css/themes');

	 mix.scripts('./resources/assets/apps/scripts/*.js', './public/assets/apps/scripts')
	 	.scripts('./resources/assets/global/plugins/bootstrap/js/*.js', './public/assets/global/plugins/bootstrap/scripts')
        .scripts('./resources/assets/global/scripts/*.js', './public/assets/global/scripts')
        .scripts('./resources/assets/pages/scripts/*.js', './public/assets/pages/scripts')
        .scripts('./resources/assets/layouts/layout4/scripts/*.js', './public/assets/layouts/layout4/scripts')
        .scripts('./resources/assets/global/plugins/select2/js/select2.js', './public/assets/global/plugins/select2/scripts');



});
