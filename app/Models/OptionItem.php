<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionItem extends ModelUuid {
    use SoftDeletes;

    public function option(): HasOne {
        return $this->hasOne(Option::class);
    }

    public function optionValues(): BelongsToMany {
        return $this->belongsToMany(OptionValue::class);
    }

    public function input(): belongsTo {
        return $this->belongsTo(Input::class);
    }
}
