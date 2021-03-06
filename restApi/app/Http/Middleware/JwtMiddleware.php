<?php

namespace App\Http\Middleware;

use Closure;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware extends BaseMiddleware{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            $user = JWTAuth::parseToken()->authenticate();
        } catch(Exception $e) {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['error' => true, 'message' => 'Token is Invalid']);
            }
            else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['error' => true, 'message' => 'Token is Expired']);
            }
            else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException){
                return response()->json(['error' => true, 'message' => 'Token is BlackListed']);
            }
            else{
                return response()->json(['error' => true, 'message' => 'Token not found']);
            }
        }
        return $next($request);
    }
}
