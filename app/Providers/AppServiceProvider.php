<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */

    // Executed after the services have been bound
	public function boot()
	{
        /*
        // Load the view and execute a controller, or in this case execute the function
        // If we are only doing one then this would be fine but if we have many it can be a bit difficult to manage
        view()->composer('resources._nav', function($view)
        {
            $view->with('latest', \App\Article::latest()->first() );
        });
        */
		//
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
