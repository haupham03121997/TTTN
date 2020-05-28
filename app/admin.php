<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class admin extends Authenticatable
{
    use Notifiable;
   protected $table='admin';
   protected $fillable = [
    'username', 'password','name','email'
];
public function roles()
{
    return $this->belongsToMany(Role::class,'role_admin');
}
}
