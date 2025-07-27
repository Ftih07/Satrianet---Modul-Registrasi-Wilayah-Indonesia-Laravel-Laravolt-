<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\{Province, City, District, Village};

class Registration extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'phone',
        'referral',
        'status',
        'koordinat',
        'alamat_spesifik',
        'province_code',
        'city_code',
        'district_code',
        'village_code',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_code', 'code');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_code', 'code');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
