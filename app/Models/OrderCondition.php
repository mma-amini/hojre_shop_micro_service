<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderCondition extends Model {
    use SoftDeletes;
    
    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }
    
    public function orderDesigns(): HasMany {
        return $this->hasMany(OrderDesign::class);
    }
}
