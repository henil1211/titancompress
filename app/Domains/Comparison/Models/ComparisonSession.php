<?php

namespace App\Domains\Comparison\Models;

use App\Models\User;
use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ComparisonSession extends Model
{
    use HasUuids;

    protected $table = 'comparison_sessions';

    protected $fillable = ['user_id', 'session_token', 'slug'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(
            Product::class,
            ComparisonItem::class,
            'session_id',
            'id',
            'id',
            'product_id'
        );
    }
}
