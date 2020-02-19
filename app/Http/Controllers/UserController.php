<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Contracts\UpdateContract as UpdateContract;
use App\Services\UpdateRegistrar as UpdateRegistrar;
use App\FeedUser;


class UserController extends Controller
{
    protected $update;

	protected $updateRegistrar;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
    public function __construct(UpdateContract $update, UpdateRegistrar $updateRegistrar)
	{
        $this->update = $update;
        $this->updateRegistrar = $updateRegistrar;
    }

    /**
	 * Take user to add update page
	 *
	 * @return Response
	 */
    public function showAddUpdate($id) {
		return view('user.update')->with([ 'userID' => $id ]);
    }

    public function doAddUpdate($id, Request $request) {
        $userInput = array(
            'update' => $request->input('update')
        );

        $validation = $this->updateRegistrar->validator($userInput);

        if($validation) {
             $result = $this->updateRegistrar->create($userInput, $id);
             if ( $result )
			{
				// Update posted. Redirect to newsfeed
				return view('user.newsfeed')->with([ 'message' => 'Update successfully posted', 'user_id' => $id ]);
			}

        }

        return view('update')->withMessage('Update did not post. Please try again');


    }


    /**
	 * Show user news feed
	 *
	 * @param  $userID
	 * @return Response
	 */
	public function showFeed($userID)
	{
		// Get 40 posts from people user follows
		Redis::ltrim('posts:' . $userID, 0, 100);

		// Get post IDs
        $postIDs = Redis::lRange('posts:' . $userID, 0, 100);

		// Get post information from IDs
		$posts = $this->update->getPosts($postIDs);

		return view('user.newsfeed')->withPosts($posts);
    }

    public function showUserList($id) {
        if ( $users = FeedUser::getUserList( $id, 10 ) )
		{
			return view('user.userlist')->with([ 'users' => $users, 'current_user_id' => $id ]);
		}

		return view('user.userlist')->withMessage('No users to follow');

    }



}
