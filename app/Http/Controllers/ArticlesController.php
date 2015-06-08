<?php namespace App\Http\Controllers;

// Load the Article model
use App\Article;
use App\Tag;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// Abbreviates the above namespace (no longer required due to the CreateArticleRequest validation)
// use Request;

use Carbon\Carbon;

// If we are going to use a Facade (short name then we need to specify it within the file)
use Auth;

class ArticlesController extends Controller {

	//
    public function __construct()
    {
        // Execute the middleware "auth" as defined within the /App/Http/Kernel.php file's $routeMiddleware array
        // The second parameter is an array that enables you to specify which methods this should be in effect for (we can also use 'except')
        $this->middleware('auth', ['only' => 'create']);
    }

	public function index()
	{
        // Return the authenticated user - returns null if it doesn't exist
        // return \Auth::user()->name;

		// \App\Article - requires the complete namespace if not loaded into the entire class
		// $articles = \App\Article::all();

		// Get the latest articles - only adds the order by function
		// $articles = Article::latest()->get();

		// Get the articles that are published_at before today
		// $articles = Article::orderBy('published_at', 'desc')->where('published_at', '<=', Carbon::now())->get();

		// Using query scopes a cleaner method of retrieving all active articles
		$articles = Article::latest('published_at')->published()->get();

        // Get the latest article for the menu
        // $latest = Article::latest()->first();

		// Returning directly from the Eloquent request will return as JSON format
		// return $articles;

		// Return a view with the articles array executed by PHPs compact function
		return view('articles.index', compact('articles') ); //, 'latest') );
	}

	// public function show($id)

    // With the introduction of the Route Model Binding - the Http\Providers\RouteServiceProvider automatically sources the article item from the database
    public function show(Article $article)
	{
		// Find an article with the specific id
		// $article = Article::find($id);

		// View more details about the returned value
		// dd($article);

		// Manual method of handling if a result could not be found
		// if( ! $article ) {
		//	abort(404);
		// }


		// Laravel method of Find or fail - if there are no results then show a 404 page with the exception
		// $article = Article::findOrFail($id);

		// Die and dump - If the data is Carbon compatible then we can convert the output and modify the data
		// dd( $article->created_at->year );

		return view('articles.show', compact('article') );
	}


	public function create()
	{
        /*
        // If the user is a guest redirect to the articles page
        if( Auth::guest() )
        {
            return redirect('articles');
        }
        */

        // Retrieve all the tags
        // $tags = \App\Tags::all();

        // We can instead use the lists function which returns all the column values we select - // Name, with the ID of the associated name
        $tags = Tag::lists('name', 'id');

		return view('articles.create', compact('tags'));

	}


    // Originally a straight forward call to store the inputted data
    // public function store()

    // Upon calling store function, the CreateArticleRequest within the Requests folder is executed for automatic validation
	// public function store(Requests\CreateArticleRequest $request)

    // Alternatively we can directly add the form validation here
    //public function store(Request $request)

    public function store(Requests\ArticleRequest $request)
	{
        // Dump the input
     //  dd($request->input('tag_list'));

		// Get all inputs
		//$input = Request::all();

		// Set published at to the the Now time
		// $input['published_at'] = Carbon::now();






		// Example create instance
		// $article = new Article;
		// $article->title = $input['title'];

		// Pass the values through the constructor
		// $article = new Article([ 'title' => $input['title'] ]);

		// Use the mass assignment functionality by passing through the variables we want to define
		// Article::create($input);

		// Combine the creation stage by using the direct input
		// Article::create(Request::all());


        // Inline validation rules
        // $this->validate($request, ['title' => 'required', 'body' => 'required']);

        // As we are using the Facade we can simply use - but this will only create a new article without the user who created it
        // Article::create($request->all());


        // From the authenticated user, get them and create a new article and save it
        // $article = new Article($request->all());

        // Auth::user()->articles()->save($article);

        // Same as above - creates a new article with the user as the creator id
        // $article = Auth::user()->articles()->create($request->all());


        // Get an array of all the tags the user has selected
        //$tagIds = $request->input('tags');

        // Combing the above, attach this article to all the selected tag IDs
       // $article->tags()->attach( $request->input('tag_list') );

        // Use the private method created for the update method as sync can be used to add as well as update
        // $this->syncTags( $article, $request->input('tag_list') );



        // Combine all the steps into a single function
        $this->createArticle($request);


        // Create a new session with flash data
        // \Session is effectively declaring it globally, use Session is for this class specific
        // \Session::flash('flash_message', 'Your article has been created');
        // session()->flash('flash_message', 'Your article has been created');
        // session()->flash('flash_message_important', true);


        // Using a custom helper function to create a flash data and then assign it as important
        //flash('Your article has been created')->important();
        flash()->overlay('This is a n overlay :)');

		// Redirect to the articles view page With session flash data
		return redirect('articles');
        // ->with(['flash_message' => 'Your article has been created', 'flash_message_important' => true]);
	}

    // Method to show user an edit article view
    // public function edit($id)
    public function edit(Article $article)
    {
        $tags = Tag::lists('name', 'id');

        //$article = Article::findOrFail($id);

        return view('articles.edit', compact('article', 'tags'));
    }

    // Update a given article
    // public function update($id, Requests\ArticleRequest $request)
    public function update(Article $article, Requests\ArticleRequest $request)
    {
        //dd($request->input('tag_list') );

      //  $article = Article::findOrFail($id);

        // Update the selected article
        $article->update($request->all());

        // Synchronise the pivot table values - Laravel handles the deleting and adding of the tags
        // $article->tags()->sync( $request->input('tag_list') );

        // Cleaner method of the above
        $this->syncTags( $article, $request->input('tag_list') );

        return redirect('articles');
    }


    // Private function to synchronise the selected tags for a given article
    private function syncTags(Article $article, array $tags )
    {
        $article->tags()->sync( $tags ); //$request->input('tag_list') );
    }

    // Create an article function
    private function createArticle($request)
    {
        $article = Auth::user()->articles()->create($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        return $article;
    }

}
