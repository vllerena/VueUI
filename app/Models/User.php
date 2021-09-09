<?php

namespace App\Models;

use App\Models\Info\UserAttr;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';

    protected $fillable = [
        UserAttr::FULLNAME,
        UserAttr::EMAIL,
        UserAttr::PASSWORD,
        UserAttr::USER_TYPE,
        UserAttr::IS_ACTIVATED,
        UserAttr::PASSWORD_RESET_CODE,
        UserAttr::ACTIVATION_CODE,
        UserAttr::SOCIAL_TYPE,
        UserAttr::IS_ACTIVE,
        UserAttr::ROLE,
    ];

    protected $hidden = [
        UserAttr::PASSWORD,
    ];

    protected $casts = [
        UserAttr::IS_ACTIVATED => 'boolean',
        UserAttr::IS_ACTIVE => 'boolean',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, UserAttr::ROLE);
    }
}
