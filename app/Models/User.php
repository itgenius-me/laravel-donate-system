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

    static function getLeaderEmail($user_id){
        $user = self::find($user_id);
        $reference = self::query()->where('email', $user->reference)->get();
        $reference_email = '';
        if ($reference) $reference_email = $reference->first()->email;
        if ($reference_email == $user->email || $reference_email == '') {
            return $user->email;
        } else {
            $referrals = self::query()->where('reference', $reference_email)->count();
            if (intval($referrals) > 4 || intval($reference->first()->is_manager) == 1) return $reference_email;
            return self::getLeaderEmail($reference->first()->id);
        }
    }
}
