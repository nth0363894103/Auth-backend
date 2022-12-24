<?php

namespace App\Modules\Users;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UsersRepository {
    public function getBy($name, $value) {
        return Users::where($name, $value);
    }
    public function create($data) {
        return Users::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'fullname' => $data['fullname']
        ]);
    }
}