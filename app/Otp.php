<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use UsesUuid;

    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
