<?php

namespace App\Domains\RFQ\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RFQActivityLog extends Model
{
    protected $table = 'rfq_activity_logs';

    protected $fillable = ['rfq_id', 'user_id', 'action', 'description'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
