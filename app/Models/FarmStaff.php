<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'farms_id',
        'name',
        'surname',
        'department',
        'phoneNumber',
        'status',
        'maritalStatus',
        'dateOfBirth',
        'education',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class, 'farms_id');
    }
}