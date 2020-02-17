<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\PostContract as PostContract;
use Cache;
use Redis;


class BlogPost extends Model implements PostContract
{
  /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blog_posts';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'title', 'author', 'content'];

	/**
	 * Return all posts
	 *
	 * @return Object
	 */


    /**
	 * Return all posts
	 *
	 * @return Object
	 */
	public function fetchAll()
	{
		$result = Cache::remember('blog_posts_cache', 1, function()
		{
			return $this->get();
		});

		return $result;
	}




     public function fetch($id) {

     }

}
