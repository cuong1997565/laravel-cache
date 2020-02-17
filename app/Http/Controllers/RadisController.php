<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redis;

class RadisController extends Controller
{
    public function Radis() {
        $app = Redis::connection();
        $app->set("key2","value2");
        print_r($app->get("key2"));
    }

    public function showArticle($id) {

        // $this->id = $id;

        // $storage = Redis::Connection();


        // $views = $storage->incr('article:' . $id . ':views');

        // $storage->zIncrBy('articleViews', 1 , 'article:'. $id);

        // return 'This is an article with id: ' . $id . " it has " .$views . "    views";

        /////////////////////////////////

        // $this->id = $id;

        // $storage = Redis::Connection();

        // if($storage->zScore('articleViews', 'article:' . $id)) {
        //     $storage->pipeline(function($pipe){
        //         $pipe->zIncrBy('articleViews', $this->id ,'article:'. $this->id);
        //     });
        // } else {
        //     $views = $storage->incr('article:' . $id . ':views');
        //     $storage->zIncrBy('articleViews', $this->id ,'article:'. $this->id);
        // }

        // $views = $storage->get('article:'. $this->id . ':views');

        // return 'This is an article with id: ' . $this->id . " it has " .$views . "    views";

        /////////////////////////////////////////////

        $storage = Redis::Connection();

        $popular = $storage->zRevRange('articleViews', 0, 1);

        foreach ($popular as $key => $value) {
            $id = str_replace('article:','', $value);
            echo 'Article ' . $id . ' is popular ' . "<br />";
        }
    }
}
