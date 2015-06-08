<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->composeNavigation();
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

    private function composeNavigation()
    {
        /*
        view()->composer('resources._nav', function($view)
        {
            $view->with('latest', \App\Article::latest()->first() );
        });
        */

        // Load a view but with a composer directory to process it - with the default function of compose for data which requires a fair amount of pre-processing
        view()->composer('resources._nav', 'App\Http\Composers\NavigationComposer');
    }

}
