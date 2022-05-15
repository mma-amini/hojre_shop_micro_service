<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecValue extends ModelUuid {
    use SoftDeletes;
    
    public function specItems(): BelongsTo {
        return $this->belongsTo(SpecItem::class);
    }
}
