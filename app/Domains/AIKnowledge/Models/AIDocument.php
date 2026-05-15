<?php

namespace App\Domains\AIKnowledge\Models;

use Illuminate\Database\Eloquent\Model;

class AIDocument extends Model
{
    protected $table = 'ai_documents';

    protected $fillable = [
        'title',
        'file_path',
        'type',
        'content_extracted',
        'is_indexed',
    ];

    protected $casts = [
        'is_indexed' => 'boolean',
    ];
}
