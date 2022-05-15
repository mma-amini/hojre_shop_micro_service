<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spec extends ModelUuid {
    use SoftDeletes;
    
    public function categories(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
