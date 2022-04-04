<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends ModelUuid {
    use SoftDeletes;

    public function products(): HasOne {
        return $this->hasOne(Product::class);
    }
}
