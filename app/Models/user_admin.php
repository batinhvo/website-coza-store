<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_admin extends Model
{
    use HasFactory;
    protected $primaryKey = 'admin_id';
    protected $table = 'user_admins';

    public function roles() {
        return $this->belongsToMany('App\admin_roles');
    }
}
