<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function(){
    return 'Homepage';
});

// Route:: HTTP_METHOD, Controller@method
Route::get('about','PagesController@about');

/*
// We can specify middleware within the route definition
Route::get('about', ['middleware' => 'auth', 'users' => 'PagesController@about'] );

// We can also directly call a function from within the array
Route::get('about', ['middleware' => 'auth', function() {
    return 'test';
}]);
*/

Route::get('contact', 'PagesController@contact');

Route::get('articles', 'Articles@index');

// Quickly return a direct value
Route::get('foo', function(){
    return 'bar';
});

/*
 *
 * // Rather than do each function manually Laravel has this functionality built in

Route::get('articles', 'ArticlesController@index');

Route::get('articles/create', 'ArticlesController@create');

// Posting to the Articles Controller
Route::post('articles', 'ArticlesController@store');

// Wildcard of {id}
Route::get('articles/{id}', 'ArticlesController@show');

// Wildcard is over-riding this setting
//Route::get('articles/create', 'ArticlesController@create');

Route::get('articles/{id}/edit', 'ArticlesController@edit');


*/

// Creates all of the usual methods required for a controller - Index, Create, Store, Show, Edit, Update, Delete
Route::resource('articles', 'ArticlesController');


// DIfferent way of registering routes
Route::controllers([

    // first segment => controller to use
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

// Dummy request which executes the middleware to check the manager (returns false), then executes the function if it passes
Route::get('foo', ['middleware' => 'manager', function()
{
    return 'This view should only be viewed by managers';
}]);



route::get('test', 'TestController@index');

interface BarInterface{}
// class Baz{}

class Bar implements BarInterface{

    /*
    public $baz;

    public function __construct(Baz $baz)
    {
        $this->baz = $baz;
    }

    */
}

/*
// Manual way of binding bar to the application so we can then use it within the route
App::bind('Bar', function(){
    return new Bar(new Baz);
});
*/

/*
// We expect an instance of Bar to be imported in
// We dont need to do $bar = new Bar( new Baz);
// Laravel peeks into the type of item that needs to be passed in and creates an existance of it
// Larvavel notices that the Bar class requires an instance of the Bar class, in order to create the instance of $bar

Route::get('bar', function(Bar $bar)
{
    dd($bar);

});
*/

/*
// Manually bind the BarInterface key to the bar instance
App::bind('BarInterface', function(){
    return new Bar;
});
*/

// We are binding into the container the BarInterface with the BarClass
App::bind('BarInterface', 'Bar');

/*
// Searches through the app for a BarInterface and returns whatever is associated with it
// When we dont have the manual binding it will through an error as we cannot create an instance of an interface
Route::get('bar', function(BarInterface $bar)
{
   dd($bar);
});
*/

// We can resolve out of the container of the bar class
Route::get('bar', function(){
    $bar = App::make('BarInterface'); // Same as $bar = app('BarInterface'); or $bar = App::make()['BarInterface'];
    dd($bar);
});

Route::get('foo', 'FooController@foo');


// Show all the articles related to a tag
Route::get('tags/{tags}', 'TagsController@show');