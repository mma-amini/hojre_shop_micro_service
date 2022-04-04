<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends ModelUuid {
    use SoftDeletes;
    
    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }
}
