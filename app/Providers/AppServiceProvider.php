<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use View;
use App\Helpers\MediaManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        //Link with public folder
        View::share('publicDir', asset('public'));
        View::share('viewDir', asset('resources/views'));

        //Helpers
        View::share('Query', '\App\Helpers\Query');
        View::share('ButtonSet', '\App\Helpers\ButtonSet');
        View::share('NavMenu', '\App\Helpers\NavMenu');
        View::share('Post', '\App\Models\Post');
        View::share('Term', '\App\Models\Term');
        View::share('Component', '\App\Helpers\Component');
        View::share('FieldGenerator', '\App\Helpers\FieldGenerator');
        View::share('Media', '\App\Models\Media');
        View::share('MediaManger', function ($buttonId, $inputId, $options = []) {
            $obj = new MediaManager($buttonId, $inputId, $options);
            return $obj->openModal();
            //return $buttonId;
        });
        View::share('Model', function ($modelName) {
            $modelPath = '\App\Models' . '\\' . $modelName;
            return $modelPath;
        });
        //
    }
}
