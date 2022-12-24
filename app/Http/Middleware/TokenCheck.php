<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Users;
use App\Facades\Token;
class TokenCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header("Authorization");
        if(is_null($token)) {
            return new Response([
                "success" => false,
                "message" => trans("messages.auth.failed")
            ], Response::HTTP_UNAUTHORIZED);
        }
        $obj = Token::toObject($token);
        $user = Users::checkCSID($obj->cs, $obj->uid);
        if(!$user) {
            return new Response([
                "success" => false,
                "message" => trans("messages.auth.failed")
            ], Response::HTTP_UNAUTHORIZED);
        }
        $request->merge(["user" => (array)$user->first(), "csid" => $obj->cs, "uid" => $obj->uid]);
        return $next($request);
    }
}
