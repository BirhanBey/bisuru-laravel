<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'farms_id',
        'earing_number',
        'dateOfBirth',
        'dateOfLastBirthGiving',
        'birthNummber',
        'lactaionStatus',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class, 'farms_id');
    }
}
