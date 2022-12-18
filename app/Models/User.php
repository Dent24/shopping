<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
}
