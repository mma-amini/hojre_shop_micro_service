<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends ModelUuid {
    use SoftDeletes;

    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }
}
