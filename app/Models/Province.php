<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model {
    use SoftDeletes;

    public function userAddresses(): HasMany {
        return $this->hasMany(UserAddress::class);
    }

    public function cities(): HasMany {
        return $this->hasMany(City::class);
    }
}
