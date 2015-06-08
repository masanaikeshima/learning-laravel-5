<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */


    // Executes on each service provider after its been registered

	public function boot(Router $router)
	{
		parent::boot($router);

        // As we currently pass in a Router namespaced object of $router we can use the below alternatively we can use
        // Route::model();

        // Whenever a wildcard is used then use that as the key and the {NAME} as the model
        // We want to bind the {articles} to the App\Article model
        // $router->model('articles', 'App\Article');

        // For larger projects where simply using the wildcard as defined in the routes:list is too simple
        // We can create a bind, which enables us to execute a function instead
        $router->bind('articles', function($id)
        {
            // Ensure we can only see published articles
            return \App\Article::published()->findOrFail($id);
        });
		//

        // Return the first tag which has the name
        $router->bind('tags', function($name)
        {
           return \App\Tag::where('name', $name)->firstOrFail();
        });
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
