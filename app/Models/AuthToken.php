<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class AuthToken extends Model
{
    protected $table = 'auth_token';
    public $timestamps = false;
    public $fillable = ["csid", "uid"];
    public function scopeCSID($query, $dat) {
        return $query->where('csid', $dat);
    }
    public static function add($uid) {
        $csid = Str::random(30);
        self::create([
            "csid" => $csid,
            "uid" => $uid,
        ]);
        return $csid;
    }
    public static function del($csid) {
        return self::CSID($csid)->delete();
    }
}
