<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model {
    use SoftDeletes;

    public function province(): HasOne {
        return $this->hasOne(Province::class);
    }
}
