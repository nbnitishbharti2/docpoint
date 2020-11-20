<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = "module";
    public function Permission()
    {
    	return $this->hasMany(Permission::class);
    }
}
