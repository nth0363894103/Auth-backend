<?php

namespace App\Modules\Users;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Support\Facades\Hash;
use App\Facades\Token;
use App\Models\AuthToken;
use App\Utils\Result;
use Illuminate\Http\Response;
class UsersService {
    private UsersRepository $users;
    public function __construct(UsersRepository $u) {
        $this->users = $u;
    }
    public function login($data) : Result {
        $fieldType = filter_var($data['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $query = $this->users->getBy($fieldType, $data['username']);
        //
        if($query->count() < 1) {
            return new Result([
                "success" => false, 
                "message" => trans('messages.username_not_found')
            ], Response::HTTP_UNAUTHORIZED);
        }
        //
        if(!Hash::check($data['password'], $query->first()->password)) {
            return Result([
                "success" => false, 
                "message" => trans('messages.password_doesnt_match')
            ], Response::HTTP_UNAUTHORIZED);
        }
        //
        $payload = $query->first();
        return new Result([
            "success" => true, 
            "message" => [
                "data" => $payload,
                "token" => Token::uid($payload->uid)->cs(AuthToken::add($payload->uid))->create()
            ]
        ],  Response::HTTP_OK);
    }


    public function register($data) : Result {
        $this->users->create($data);
        return new Result([
            "success" => true, 
            "message" => trans('messages.reg.success')
        ], Response::HTTP_OK);
    }
    public function getByCSID($csid, $uid) : Result {
        return new Result([
            "success" => true, 
            "message" => $this->users->getByCSID($csid, $uid)
        ], 200);
    }
}