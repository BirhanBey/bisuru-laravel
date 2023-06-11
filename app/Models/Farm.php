<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmers_id',
        'status',
        'address',
        'phoneNumber',
        'latitude',
        'longitude',
        'surfaceArea',
        'placeOfBirth',
        'identityNumber',
        'email_verified_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farms_id');
    }
    public function farmstaff()
    {
        return $this->hasMany(FarmStaff::class, 'farms_id');
    }
    public function animals()
{
    return $this->hasMany(Animal::class, 'farms_id');
}
}
