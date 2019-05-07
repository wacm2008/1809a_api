<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class CheckLoginToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //print_r($_COOKIE);
        if(empty($_COOKIE['token'])||empty($_COOKIE['uid'])){
            header('Refresh:2;url=http://passport.1809a.com/login');
            die('请登录');
        }
        $token=$_COOKIE['token'];
        $key='uid_token'.$_COOKIE['uid'];
        $local_token=Redis::get($key);
        if($token){
            if($token==$local_token){

            }else{
                header('Refresh:2;url=http://passport.1809a.com/login');
                die('请登录');
            }
        }
        return $next($request);
    }
}
