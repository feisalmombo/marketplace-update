<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permissions\HasPermissionsTrait;
use App\Role;
use App\Permission;
use App\Product;

class User extends Authenticatable
{
    use Notifiable;
    use HasPermissionsTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'phone_number', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function status()
    {
        return $this->belongsTo('App\UserStatus');
    }

    // public function permissions() {
    //     return $this->belongsToMany(Permission::class,'roles_permissions');
    // }

    // public function products() {
    //     return $this->belongsToMany(Product::class,'roles_permissions');
    // }

    // public function loan_type(){

    //     return $this->hasMany(LoanRate::class,'product_id');
    // }
}
