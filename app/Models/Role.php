<?php

namespace App\Models;

use App\Models\Info\RoleAttr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        RoleAttr::ROLE_NAME,
        RoleAttr::PERMISSION,
        RoleAttr::IS_ADMIN,
    ];
}
