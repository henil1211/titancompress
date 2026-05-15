<?php

namespace App\Domains\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpecificationGroup extends Model
{
    protected $fillable = ['name', 'sort_order'];

    public function attributes(): HasMany
    {
        return $this->hasMany(SpecificationAttribute::class, 'group_id')->orderBy('sort_order');
    }
}
