<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='roles';
    protected $fillable = [
        'name', 'display_name'
    ];
    public function permission()
{
    return $this->belongsToMany(permission::class,'role_permission');
}
}
