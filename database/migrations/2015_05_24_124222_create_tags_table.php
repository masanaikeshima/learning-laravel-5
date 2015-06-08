<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name'); // name of the tag
			$table->timestamps();
		});

        Schema::create('article_tag', function(Blueprint $table)
        {
            $table->integer('article_id')->unsigned()->index();

            // Create a foreign key on the ID column within the articles table, when deleting an article delete this key as well
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

            $table->integer('tag_id')->unsigned()->index();

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->timestamps();


        }); // articles and tags - naming convention singular and in alphabetical order
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tags');
        Schema::drop('article_tag');
	}

}
