<?php namespace App\Http\Middleware;

use Closure;

class Demo {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        // We can use various functions given that we are passing through a request which has lots of built in functionality like checking what page were on
        // $request->is('articles/create');

        // Check to see if the url is articles/create and has a GET key of foo
        // Dangers of endless loops
        if($request->is('articles/create') && $request->has('foo'))
        {
            return redirect('articles');
        }


		return $next($request);
	}

}
