<?php
/**
 * Created by PhpStorm.
 * User: ktwzj
 * Date: 2018/5/4
 * Time: 21:42
 */

namespace App\Providers;


use App\Card;

class AuthCardProvider
{
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                return Card::where('api_token', $request->input('api_token'))->first();
            }
        });
    }

}