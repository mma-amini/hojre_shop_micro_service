<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionValue extends ModelUuid {
    use SoftDeletes;

    public function optionItems(): BelongsToMany {
        return $this->belongsToMany(OptionItem::class);
    }
}
