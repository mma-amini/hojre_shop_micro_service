<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecItem extends ModelUuid {
    use SoftDeletes;
    
    public function spec(): HasOne {
        return $this->hasOne(Spec::class);
    }
    
    public function specValues(): BelongsToMany {
        return $this->belongsToMany(SpecValue::class);
    }
    
    public function input(): belongsTo {
        return $this->belongsTo(Input::class);
    }
}
