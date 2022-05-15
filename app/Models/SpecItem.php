<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecItem extends ModelUuid {
    use SoftDeletes;
    
    public function specValues(): BelongsTo {
        return $this->belongsTo(SpecValue::class);
    }
}
