<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Redis;
use App\Contracts\PostContract;


class BlogController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(PostContract $post)
	{
        $this->post = $post;
	}

	/**
	 * Show main blog with posts
	 *
	 * @return Response
	 */
	public function showBlog()
	{

        DB::connection()->enableQueryLog();
        $posts = $this->post->fetchAll();
        $log = DB::getQueryLog();
       print_r($log);

		// return view('posts')->with([ 'posts' => $posts ]);
	}


}
