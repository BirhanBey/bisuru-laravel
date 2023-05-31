<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'admins';
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'phone_number',
        'status',
        'image',
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

    public function loginLogs()
    {
        return $this->hasMany(AdminLoginLog::class, 'admins_id');
    }

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_users_roles', 'admins_id', 'admin_roles_id');
    }
}

class AdminLoginLog extends Model
{
    protected $table = 'admin_login_logs';
    protected $fillable = [
        'loginType', 
        'browser', 
        'IP', 
        'browserLang', 
        'status'
    ];
    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admins_id');
    }
}
