<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AppUserRole;
use Illuminate\Support\Facades\Validator;
class AppOwnerMiddleware
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
        $validator = Validator::make($request->all(), [
            'appid' => "bail|required|min:40|max:40"
        ]);
        if ($validator->fails()) {
            return new Response([
                "success" => false,
                "message" => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
        if(!AppUserRole::where("uid", $request->uid)->where("appid", $validator->validated()["appid"])->count()) {
            return response()->json([
                "success" => false, 
                "message" => "User is not a owner of app"
            ]);
        }
        return $next($request);
    }
}
