<?php

namespace App\Domains\RFQ\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RFQ extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'rfqs';

    protected $fillable = [
        'status_id',
        'assigned_to',
        'customer_name',
        'company_name',
        'email',
        'phone',
        'country',
        'industry',
        'technical_requirements',
        'additional_notes',
        'lead_source',
        'priority',
    ];

    protected $casts = [
        'technical_requirements' => 'array',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(RFQStatus::class, 'status_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function items(): HasMany
    {
        return $this->hasMany(RFQItem::class, 'rfq_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(RFQAttachment::class, 'rfq_id');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(RFQNote::class, 'rfq_id');
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(RFQActivityLog::class, 'rfq_id');
    }
}
