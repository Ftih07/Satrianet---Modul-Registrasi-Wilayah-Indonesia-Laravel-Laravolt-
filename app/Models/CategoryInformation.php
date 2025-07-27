<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryInformation extends Model
{
    protected $table = 'category_information';

    protected $fillable = [
        'title',
        'descriptions',
    ];

    public function informations()
    {
        return $this->hasMany(Information::class, 'category_information_id');
    }
}
