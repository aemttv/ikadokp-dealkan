<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class d_User extends Model // Extend the Authenticatable class
{
//     use HasFactory;

//     protected $table = 'd_users'; // Ensure this matches your table name

//     protected $fillable = ['name', 'role', 'email', 'noHP', 'noWA', 'password', 'status'];

//     // If you need to hide the password in JSON responses, you can do this
//     protected $hidden = ['password'];
}
