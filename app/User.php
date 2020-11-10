<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Traits\UsesUuid;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, UsesUuid;


    protected function get_user_role_id()
    {
        $role = \App\Role::where('name', 'user')->first();
        return $role->id;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->role_id = $model->get_user_role_id();
        });

        static::created(function ($model) {
            $model->generate_code_otp();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        if ($this->role_id === $this->get_user_role_id()) {
            return false;
        }

        return true;
    }

    public function generate_code_otp()
    {
        do {
            $random = mt_rand(100000, 999999);
            $check = Otp::where('otp', $random)->first();
        } while ($check);

        $now = Carbon::now();

        //create otp code

        $otp_code = Otp::updateOrCreate(
            ['user_id' => $this->id],
            ['otp' => $random, 'valid_until' => $now->addMinutes(5)]
        );
    }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function otp()
    {
        return $this->belongsTo(Otp::class);
    }
}
