<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUserRole extends Model
{
    protected $table = 'apps_user_role';
    public $timestamps = false;

    protected $fillable = ["uid", "appid"];
}
