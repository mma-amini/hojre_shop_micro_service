<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends ModelUuid {
    use SoftDeletes;

    public function user(): HasOne {
        return $this->hasOne(User::class);
    }

    public function userAddress(): HasOne {
        return $this->hasOne(UserAddress::class);
    }

    public function orderCondition(): HasOne {
        return $this->hasOne(OrderCondition::class);
    }

    public function orderDesigns(): HasMany {
        return $this->hasMany(OrderDesign::class);
    }
}
