<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Passport\HasApiTokens;
use App\Helpers\HasGuidTrait;
use Spatie\Permission\Traits\HasRoles;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasGuidTrait;
    use HasRoles;
    // use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'guid',
        'reference',
        'name',
        'email',
        'cellphone',
        'cellphone_code',
        'activated',
        'is_manager',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
