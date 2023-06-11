<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CooperativeStaff extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cooperative_staffs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cooperatives_id',
        'name',
        'surname',
        'department',
        'dateOfBirth',
        'placeOfBirth',
        'phoneNumber',
        'identityNumber',
        'maritalStatus',
        'numberOfKids',
        'address',
        'field',
        'status',
        'licenseNo',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get the cooperative associated with the staff.
     */
    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class, 'cooperatives_id');
    }
}
