<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'phone_number',
        'status',
        'image',
        'email_verified_at',
        'admin_id',
    ];
    protected $guarded = [];

        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function loginLogs()
    {
        return $this->hasMany(CustomerLoginLog::class, 'customers_id');
    }

    public function roles()
    {
        return $this->belongsToMany(CustomerRole::class, 'customer_users_roles', 'customers_id', 'customer_roles_id');
    }
}

class CustomerLoginLog extends Model
{
    protected $table = 'customer_login_logs';
    protected $fillable = [
        'loginType', 
        'browser', 
        'IP', 
        'browserLang', 
        'status'
    ];
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }
}
