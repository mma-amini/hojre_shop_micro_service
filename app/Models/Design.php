<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Design extends ModelUuid {
    use SoftDeletes;
    
    public function shop(): HasOne {
        return $this->hasOne(Shop::class);
    }
    
    public function product(): HasOne {
        return $this->hasOne(Product::class);
    }
    
    public function warranty(): BelongsTo {
        return $this->belongsTo(Warranty::class);
    }
    
    public function orderDesigns(): HasMany {
        return $this->hasMany(OrderDesign::class);
    }
}
