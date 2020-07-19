<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Closure;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next){
        if($request->user() &&
        ! $request->user()->hasVerifiedEmail() && 
        ! $request->is('email/*','logout')
        ){
            return $request->expectsJson()
             ? abort(403, 'Your email address is not verified.')
             : redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
