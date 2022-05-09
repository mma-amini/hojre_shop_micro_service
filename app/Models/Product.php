<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends ModelUuid {
    use SoftDeletes;

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function shops(): BelongsToMany {
        return $this->belongsToMany(Shop::class, 'product_shop');
    }

    public function designs(): HasMany {
        return $this->hasMany(Design::class);
    }

    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class);
    }

    public function productImages(): HasMany {
        return $this->hasMany(productImage::class);
    }
}
