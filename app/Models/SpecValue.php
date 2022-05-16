<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecValue extends ModelUuid {
    use SoftDeletes;
    
    public function specItems(): BelongsToMany {
        return $this->belongsToMany(SpecItem::class);
    }
}
