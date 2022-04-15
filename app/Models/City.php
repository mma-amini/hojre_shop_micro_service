<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends ModelUuid {
    use SoftDeletes;

    public function province(): HasOne {
        return $this->hasOne(Province::class);
    }
}
