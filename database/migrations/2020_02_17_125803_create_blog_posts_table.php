<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('author');
			$table->bigInteger('author_id')->unsigned();
			$table->text('desc');
			$table->text('content');
			$table->string('image_url');
			$table->unsignedInteger('comment_count');
			$table->string('access');
			$table->timestamps();
		});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
