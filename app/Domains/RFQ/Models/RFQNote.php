<?php

namespace App\Domains\RFQ\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RFQNote extends Model
{
    protected $table = 'rfq_notes';

    protected $fillable = ['rfq_id', 'user_id', 'content'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
