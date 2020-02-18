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
	protected $fillable = ['id', 'title', 'author', 'content','author_id','desc','image_url','comment_count','access'];

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

    /**
	 * Return a specific post
	 *
	 * @param  int $id post ID
	 * @return Object
	 */
     public function fetch($id) {
    //     DB::connection()->enableQueryLog();
    //     $query = $this->where('id', $id)->first();
    //     dd(DB::getQueryLog());
    //    return $query;
        return $this->where('id', $id)->first();
     }

     /**
	 * Get specific articles
	 *
	 * @param  array $id post IDs
	 * @return object    posts
	 */

     public function filterFetch($name) {
        return $this->whereIn('id', $name)->get();
     }

}
