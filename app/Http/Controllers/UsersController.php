<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Validator;
use App\Facades\JWT;
use Illuminate\Http\Response;
use App\Facades\Token;
use App\Modules\Users\UsersService;
use App\Models\AuthToken;
class UsersController extends Controller
{
    private UsersService $users;
    //
    public function __construct(UsersService $user)
    {
        $this->users = $user;
    }

    public function login(Request $request) {
        //var_dump($request);
        $body = $request->all();
        $validator = Validator::make($body, [
            'username' => "bail|required|min:3|max:255",
            'password' => "required|min:3|max:255"
        ]);
        if ($validator->fails()) {
            return new Response([
                "success" => false,
                "message" => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
        return $this->users->login($validator->validated())->toResponse();
    }
    public function register(Request $request) {
        //var_dump($request);
        $body = $request->all();
        $validator = Validator::make($body, [
            'username' => "bail|required|min:3|max:255|unique:users",
            'password' => "required|min:3|max:255",
            'fullname' => "required|min:3|max:255",
            'email' => "required|email|unique:users"
        ], [
            'username.unique' => trans('messages.username.unique'),
            'email.unique' => trans('messages.email.unique')
        ]);
        if ($validator->fails()) {
            return new Response([
                "success" => false,
                "message" => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
        return $this->users->register($validator->validated())->toResponse();
    }
    public function get(Request $request) {
        return new Response([
            "success" => true,
            "message" => $request->user
        ], 200);
    }
    public function logout(Request $request) {
        return new Response([
            "success" => (bool)AuthToken::del($request->csid)
        ], 200);
    }
}
