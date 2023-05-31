<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUserRole extends Model
{
    use HasFactory;

    protected $table = 'admin_users_roles';
    protected $fillable = [
        'admins_id',
        'admin_roles_id',
    ];
    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admins_id');
    }

    public function adminRole()
    {
        return $this->belongsTo(AdminRole::class, 'admin_roles_id');
    }
}
