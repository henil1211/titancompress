<?php

namespace App\Domains\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $table = 'pages';

    protected $fillable = [
        'title',
        'slug',
        'content_blocks',
        'template',
        'meta_title',
        'meta_description',
        'is_published',
    ];

    protected $casts = [
        'content_blocks' => 'array',
        'is_published' => 'boolean',
    ];
}
