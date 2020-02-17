<?php namespace App\Contracts;

interface PostContract {

	/**
	 * Retrieve all posts
	 *
	 * @return Object posts
	 */
	public function fetchAll();

	/**
	 * Retrieve specific post
	 * @param  int $id post ID
	 * @return Object
	 */
	public function fetch($id);
}
