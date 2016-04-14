<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.04.2016
 * Time: 16:13
 */

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {



        // Если композер реализуется в функции-замыкании:
        View::composer('dashboard', function()
        {
          return view('data',1);
        });
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }



}