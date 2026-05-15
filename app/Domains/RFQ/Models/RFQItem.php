<?php

namespace App\Domains\RFQ\Models;

use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RFQItem extends Model
{
    protected $table = 'rfq_items';

    protected $fillable = [
        'rfq_id',
        'product_id',
        'product_name',
        'quantity',
    ];

    public function rfq(): BelongsTo
    {
        return $this->belongsTo(RFQ::class, 'rfq_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
