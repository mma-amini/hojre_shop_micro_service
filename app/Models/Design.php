<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Design extends ModelUuid {
    use SoftDeletes;

    public function shop(): HasOne {
        return $this->hasOne(Shop::class);
    }

    public function product(): HasOne {
        return $this->hasOne(Product::class);
    }

    public function warranty(): HasOne {
        return $this->hasOne(Warranty::class);
    }
}
