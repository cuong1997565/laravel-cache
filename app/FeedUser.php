<?php namespace App;

use Illuminate\Support\Facades\Redis;
use App\Contracts\FeedUserContract as FeedUserContract;

class FeedUser implements FeedUserContract
{

	/**
	 * Get a list of users
	 *
	 * @param  array  $data
	 * @return Boolean
	 */
    public static function getUserList($userID, $num) {
        // Get users
		$userList = Redis::lRange('users', 0, $num);

		if ( $userList != '' )
		{
			$users = [];

			foreach ($userList as $value)
			{
				// We need just the ID number for the follow URL
				$filteredID = str_replace('user:', '', $value);

				// Don't show the current user
				if ( $filteredID != $userID )
				{
					$users[$value]['username'] = ucfirst(Redis::hGet($value, 'username'));
					$users[$value]['id'] = $filteredID;
				}

			}

			return $users;
		}
		return false;

    }
}
