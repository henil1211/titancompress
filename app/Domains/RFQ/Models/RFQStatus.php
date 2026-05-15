<?php

namespace App\Domains\RFQ\Models;

use Illuminate\Database\Eloquent\Model;

class RFQStatus extends Model
{
    protected $table = 'rfq_statuses';

    protected $fillable = ['name', 'color_hex', 'sort_order'];
}
