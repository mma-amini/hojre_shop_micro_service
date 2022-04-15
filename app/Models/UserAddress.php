<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends ModelUuid {
    use SoftDeletes;
    
    public function user(): HasOne {
        return $this->hasOne(User::class);
    }
    
    public function province(): HasOne {
        return $this->hasOne(Province::class);
    }
    
    public function city(): HasOne {
        return $this->hasOne(City::class);
    }
}
