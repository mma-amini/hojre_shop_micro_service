<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends ModelUuid {
    use SoftDeletes;

    public function categories(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function optionItems(): HasMany {
        return $this->hasMany(OptionItem::class);
    }
}
