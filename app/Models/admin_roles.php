<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_roles extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $primaryKey = 'roles_id';
    protected $table = 'admin_roles';

    public function admin() {
        return $this->belongsToMany('App\user_admin');
    }
}
