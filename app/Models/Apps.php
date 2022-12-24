<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Apps extends Model
{
    protected $table = 'apps';
    public $timestamps = false;
    protected $guarded = ['id', 'appid'];

    protected $attributes = [
        'appid' => ''
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['appid'] = Str::random(40);
    }
}
