<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = [
        'title',
        'image',
        'sub_title',
        'slug',
        'category_information_id',
        'content',
        'meta_keywords',
        'status',
        'start_date', // ← new
        'end_date',   // ← new
    ];

    public function category()
    {
        return $this->belongsTo(CategoryInformation::class, 'category_information_id');
    }

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
