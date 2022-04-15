<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDesign extends ModelUuid {
    use SoftDeletes;

    public function order(): HasOne {
        return $this->hasOne(Order::class);
    }

    public function deign(): HasOne {
        return $this->hasOne(Design::class);
    }

    public function shop(): HasOne {
        return $this->hasOne(Shop::class);
    }

    public function orderCondition(): HasOne {
        return $this->hasOne(OrderCondition::class);
    }
}
