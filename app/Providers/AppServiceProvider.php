<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            'App\Services\PostRegistrar',
            'App\Services\UpdateRegistrar'
		);

		$this->app->bind('App\Contracts\PostContract', 'App\BlogPost');
        $this->app->bind('App\Contracts\UpdateContract', 'App\Update');
        $this->app->bind('App\Contracts\FeedUserContract', 'App\FeedUser');



    }
}
