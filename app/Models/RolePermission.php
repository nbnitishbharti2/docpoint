<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'role_permission';
    public $timestamps = false;
    protected $fillable = [
        'permission_id', 'role_id'
    ];

    public function Permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }
}
