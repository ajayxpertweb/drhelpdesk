<?php

namespace App\Http\Middleware;
use Config;
use Closure;

class CheckToken
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
        $token = config('app.api-token');
        if(!empty($request->header('access-token'))){
            if($token==$request->header('access-token')){
                return $next($request);             
            }else{
                return response()->json([
                'code'=>200,
                'status'=>'Invalid AccessToken',
                'message' => 'Please Login! Session Expired .'
                ]);
            }

        }else{
            return response()->json([
                'code'=>200,
                'status'=>'Header Not Found ',
                'message' => 'Invalid AccessToken.'
            ]);
        }
        return $next($request);
    }
}
