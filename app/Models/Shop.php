<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends ModelUuid {
    use SoftDeletes;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'category_shop');
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class);
    }
    
    public function orderDesigns(): HasMany {
        return $this->hasMany(OrderDesign::class);
    }
}
