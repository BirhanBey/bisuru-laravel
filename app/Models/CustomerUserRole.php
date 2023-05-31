<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerUserRole extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_users_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customers_id',
        'customer_roles_id',
    ];

    /**
     * Get the customer associated with the user role.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }

    /**
     * Get the customer role associated with the user role.
     */
    public function customerRole()
    {
        return $this->belongsTo(CustomerRole::class, 'customer_roles_id');
    }
}
