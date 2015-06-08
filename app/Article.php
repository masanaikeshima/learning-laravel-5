<?php namespace App;

// Import Carbon
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	// Which fields are allowed to be mass assigned by the end user - other fields will not be editable
	protected $fillable = [
		'title',
		'body',
		'published_at',
        'user_id'
	];

	// Columns specified here can then be treated as Carbon dates
	protected $dates = ['published_at'];


	// Scope enables us to create a function to quickly limit the results
	// Format: scope <name> (we can pass an additional value by scope <name>($query, $value)
	public function scopePublished($query)
	{
		$query->where('published_at', '<=', Carbon::now());
	}

	public function scopeUnpublished($query)
	{
		$query->where('published_at', '>', Carbon::now());
	}

	// Mutators alter the input before they get added into the database
	// Format: Set <name> <attrbute>
	public function setPublishedAtAttribute($date)
	{
		$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
	}

    // By defining this we can ensure that there will always be an instance of carbon when we request the published_at attribute from the create view instead of null
    public function getPublishedAtAttribute($date)
    {
        return new Carbon($date);
    }

    // An article is owned by a user
    // Get all articles that belong to a user
    // Called like $article->user->toArray() - NOT $article->user()->toArray() as user() will return a collection, which then needs ->get()->toArray() to achieve the same results
    public function user()
    {
        // Relationship based on the foreign key that was setup (has many relationship)
        return $this->belongsTo('App\User');

    }

    // Get all articles that belongs to many tags
    public function tags()
    {
        // As tags, unlike users, can be a many to many relationship we need to use belongsToMany which uses a pivot table (relationship table) to get the relationships.
        // return $this->belongsToMany('App\Tag');

        // As we use timestamps we need to explicitly stateic this within the method
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    // Get a list of tag ids associated with this current article
    // Called by $article->taglist or $article->tag_list
    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }
}
