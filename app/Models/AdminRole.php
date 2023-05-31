<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;

    protected $table = 'admin_roles';
    protected $fillable = [
        'mainID',
        'title',
        'status'
    ];
    protected $guarded = [];

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_users_roles', 'admin_roles_id', 'admins_id');
    }
}
