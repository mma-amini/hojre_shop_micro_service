<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends ModelUuid {
    use SoftDeletes;
    
    public function users() {
        return $this->belongsToMany(User::class, 'role_user');
    }
}