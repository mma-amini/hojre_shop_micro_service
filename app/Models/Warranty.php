<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warranty extends ModelUuid {
    use SoftDeletes;
    
    public function designs(): HasMany {
        return $this->HasMany(Design::class);
    }
}
