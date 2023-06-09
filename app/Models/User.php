<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        $permissionList = [];

        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                if (!in_array($permission->id, $permissionList)) {
                    $permissionList[] = $permission->id;
                }
            }
        }

        return $permissionList;
    }

    public function hasPermission($permission)
    {
        if ($this->permissions()) {
            if (in_array($permission, $this->permissions())) {
                return true;
            }
        }

        return false;
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}
