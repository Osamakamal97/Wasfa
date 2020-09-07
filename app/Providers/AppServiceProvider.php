<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Macro for where like
        // Builder::macro('whereLike', function($attributes, string $searchTerm) {
        //     foreach(array_wrap($attributes) as $attribute) {
        //        $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        //     }
            
        //     return $this;
        //  });
    }
}
