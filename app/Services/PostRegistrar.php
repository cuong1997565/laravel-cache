<?php
namespace App\Services;

use App\BlogPost as Post;
use Validator;

class PostRegistrar {
    /**
	 * Get a validator for an incoming post submission.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'title' => 'required|max:255',
			'author' => 'required|max:255',
			'content' => 'required|min:6',
		]);
	}

	/**
	 * Create a new post instance after a valid submission.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return Post::create([
			'title' => $data['title'],
			'author' => $data['author'],
            'content' => $data['content'],
            'author_id' => 1,
            'desc' => 'qweqwe',
            'image_url' => 1,
            'comment_count' => 1,
            'access' => 'qweqwe'

		]);
	}

}
