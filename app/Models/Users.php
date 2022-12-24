<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
class Users extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    public function scopeRole($query, $dat) {
        return $query->where('role', $dat);
    }
    protected $hidden = ['password'];
    protected $guarded = ['id', 'uid'];
    protected $attributes = [
        'uid' => ''
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['uid'] = Str::random(20);
    }
    public static function checkCSID($csid, $uid) {
        $row = DB::select("SELECT DISTINCT users.id, users.uid, users.username, users.email, users.fullname, users.role FROM users
        INNER JOIN auth_token ON auth_token.uid = users.uid
        WHERE auth_token.csid = ?", [$csid]);

        if(!$row) return false;

        $col = collect($row);
        if($col->isEmpty()) return false;
        return $col;
    }
}
