<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Input extends ModelUuid {
    use SoftDeletes;

    public function specItems(): HasMany {
        return $this->hasMany(OptionItem::class);
    }
}
