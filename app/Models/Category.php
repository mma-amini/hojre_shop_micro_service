<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends ModelUuid {
    use SoftDeletes;

    public function shops(): BelongsToMany {
        return $this->belongsToMany(Shop::class, 'category_shop');
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function options(): BelongsToMany {
        return $this->belongsToMany(Option::class);
    }
}
