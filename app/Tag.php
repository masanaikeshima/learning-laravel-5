<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	// Fillable fields for this model


    protected $fillable = ['name'];


        // Get the articles associated with a given tag

        public function articles()
        {
            // $this->belongsToMany( <Name of model class>, <foreign key>, <primary key> )
            return $this->belongsToMany('App\Article'); //, "tags_pivot");
        }
}
