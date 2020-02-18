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

        // DB::connection()->enableQueryLog();
        $posts = $this->post->fetchAll();
        // $log = DB::getQueryLog();
        $tags = Redis::sRandMember('article:tags', 4);
		return view('home')->with([ 'posts' => $posts , 'tags' => $tags]);
    }

    public function showArticle($id) {
        $article = $this->post->fetch($id);
        if($article) {
            // Increment article views
			$views = Redis::pipeline(function ($pipe) use ($id)
			{
				$pipe->zIncrBy('articleViews', 1, 'article:' . $id);
				$pipe->incr('article:' . $id . ':views');
			});

			// Get number of views from resulting array of Redis::pipeline
			$views = $views['1'];

            $tags = Redis::sMembers('article:' . $id . ':tags');

			return view('blog.article')->with([ 'article' => $article, 'views' => $views, 'tags' => $tags ]);
        }

        return view('errors.404');
    }

    public function showFilteredArticles($name) {
            // Array of post IDs matching the tag filter
            $postIDs = Redis::zRange('article:tag:' . $name, 0, -1);

            // Fetch posts
            $posts = $this->post->filterFetch($postIDs);


            // Return more random tags
            // We can ensure we don't repeat the same tag by fetching +1 tag
            // and checking if it matches $tag
            $tags = Redis::sRandMember('article:tags', 4);

            return view('home')->with([ 'posts' => $posts, 'tags' => $tags ]);


    }


}
