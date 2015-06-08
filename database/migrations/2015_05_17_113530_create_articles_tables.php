<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned();
			$table->string('title');
			$table->text('body');
			$table->timestamps();
			$table->timestamp('published_at');

            // Create a foreign key for the user_id
            // When a user deletes an account, cascade down and delete their articles
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Note - Create a new migration if we are to alter an existing populated database
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles');
	}

}
